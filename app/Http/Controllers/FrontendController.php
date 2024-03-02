<?php

namespace App\Http\Controllers;

use App\Helpers\Reply;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\News;
use Illuminate\Http\Request;

class FrontendController extends Controller {
    public function index() {
        $data = [
            'featured_news' => News::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->inRandomOrder()->take(4)->get(),
            'national' => News::where('category_id', 1)->latest()->take(5)->get(),
            'pennsylvania' => News::where('category_id', 2)->latest()->take(5)->get(),
            'america' => News::where('category_id', 4)->latest()->take(6)->get(),
            'politics' => News::where('category_id', 3)->latest()->take(5)->get(),
            'economy' => News::where('category_id', 5)->latest()->take(5)->get(),
            'sports' => News::where('category_id', 6)->latest()->take(5)->get(),
            'international' => News::where('category_id', 7)->latest()->take(4)->get(),
            'entertainment' => News::where('category_id', 8)->latest()->take(4)->get(),
            'gallery' => Gallery::latest()->take(10)->get(),
        ];
        return view('frontend.index', $data);
    }

    public function category($slug) {
        $category = Category::where('slug', $slug)->first();
        $data = [
            'category' => $category,
            'all_news' => News::where('category_id', $category->id)->latest()->paginate(15),
            'related_popular_news' => News::where('category_id', $category->id)->orderBy('view_count', 'DESC')->take(5)->get(),
            'page_title' => $category->name,
        ];
        return view('frontend.category', $data);
    }

    public function news($slug) {
        $news = News::where('slug', $slug)->with('comments')->first();
        $news->view_count = $news->view_count + 1;
        $news->save();
        $data = [
            'news' => $news,
            'related_popular_news' => News::where('category_id', $news->category_id)->orderBy('view_count', 'DESC')->take(5)->get()->except($news->id),
            'page_title' => $news->title,
        ];
        return view('frontend.single-news', $data);
    }

    public function comment(CommentStoreRequest $request) {
        $status = auth()->check() ? 'Approved' : 'Pending';
        $message = auth()->check() ? 'আপনার মন্তব্যটি গ্রহণ করা হয়েছে। ধন্যবাদ।' : 'আপনার মন্তব্যটি গ্রহণ করা হয়েছে। অনুগ্রহ করে এপ্রুভ এর জন্য অপেক্ষা করুন। ধন্যবাদ।';
        Comment::create([
            'comment' => $request->comment,
            'name' => $request->name,
            'user_id' => auth()->check() ? auth()->user()->id : null,
            'news_id' => $request->id,
            'status' => $status,
        ]);
        return Reply::dataOnly(['status' => $status, 'message' => $message]);
    }

    public function archives(Request $request) {
        $data = [
            'categories' => Category::all(),
            'related_popular_news' => News::orderBy('view_count', 'DESC')->take(5)->get(),
            'page_title' => 'আর্কাইভ',
        ];

        $news =  News::latest()->with('category');

        if ($request->category != '') {
            $news->where('category_id', $request->category);
        }

        if ($request->date != '') {
            $news->whereDate('created_at', $request->date);
        }

        if ($request->search != '') {
            $news->where('title', 'like', '%' . $request->search . '%');
        }

        $data['all_news'] = $news->paginate(20)->withQueryString();
        return view('frontend.archives', $data);
    }

    public function ads() {
        return 'yes';
    }
}
