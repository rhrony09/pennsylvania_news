<?php

namespace App\Http\Controllers;

use App\Helpers\Reply;
use App\Http\Requests\News\NewsStoreRequest;
use App\Models\Category;
use App\Models\News;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller {
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (!in_array(auth()->user()->role->id, [1, 2, 3])) {
                abort(403, 'Unauthorized.');
            } else {
                return $next($request);
            }
        });
    }

    public function index() {
        $data = [
            'all_news' => News::latest()->get(),
            'page_title' => 'News',
        ];
        return view('dashboard.News.index', $data);
    }

    public function create() {
        $data = [
            'categories' => Category::all(),
            'page_title' => 'Add New News',
        ];
        return view('dashboard.News.create', $data);
    }

    public function store(NewsStoreRequest $request) {
        DB::beginTransaction();
        try {
            $news = News::create([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => make_slug($request->title),
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
            ]);

            if ($request->has('featured_image')) {
                $extension = $request->featured_image->getClientOriginalExtension();
                $image_name = $news->id . '-' . uniqid() . '.' . $extension;
                $image_path = 'uploads/news/' . $image_name;
                Image::make($request->featured_image)->fit(1000, 560)->save(public_path($image_path));

                $news->update([
                    'featured_image' => $image_name,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return Reply::error($e->getMessage());
        }

        return Reply::success('News published successfully.');
    }

    public function edit(News $news) {
        $data = [
            'news' => $news,
            'categories' => Category::all(),
            'page_title' => 'Edit News',
        ];
        return view('dashboard.News.edit', $data);
    }

    public function update(NewsStoreRequest $request) {
        $news = News::find($request->id);
        DB::beginTransaction();
        try {
            $news->update([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => make_slug($request->title),
                'category_id' => $request->category_id
            ]);

            if ($request->has('featured_image')) {
                $extension = $request->featured_image->getClientOriginalExtension();
                $image_name = $news->id . '-' . uniqid() . '.' . $extension;
                $image_path = 'uploads/news/' . $image_name;

                unlink('uploads/news/' . $news->featured_image);
                Image::make($request->featured_image)->fit(1000, 560)->save(public_path($image_path));

                $news->update([
                    'featured_image' => $image_name,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return Reply::error($e->getMessage());
        }

        return Reply::success('News updated successfully.');
    }

    public function delete(News $news) {
        $news->delete();
        unlink('uploads/news/' . $news->featured_image);
        return back()->with('success', 'News deleted successfully.');
    }
}
