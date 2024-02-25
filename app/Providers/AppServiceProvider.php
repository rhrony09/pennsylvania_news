<?php

namespace App\Providers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    public $settings;
    public $news_categories;
    public $latest_news;
    public $popular_news;
    public $comments;
    public $social_medias;
    public $ads;

    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Paginator::useBootstrap();
        if (Schema::hasTable('settings')) {
            foreach (Setting::get(['key', 'value']) as $setting) {
                $this->settings[$setting->key] = $setting->value;
            }
            $this->settings = json_decode(json_encode($this->settings), false);
        }
        if (Schema::hasTable('categories')) {
            $this->news_categories = Category::all();
        }
        if (Schema::hasTable('news')) {
            $this->latest_news = News::latest()->get();
            $this->popular_news = News::orderBy('view_count', 'DESC')->take(20)->get();
        }
        if (Schema::hasTable('comments')) {
            $this->comments = Comment::latest()->with('user')->get();
        }
        if (Schema::hasTable('social_media')) {
            $this->social_medias = SocialMedia::all();
        }
        if (Schema::hasTable('ads')) {
            $this->ads = Ad::inRandomOrder()->get();
        }

        view()->composer('*', function ($view) {
            $view->with([
                'settings' => $this->settings,
                'news_categories' => $this->news_categories,
                'latest_news' => $this->latest_news,
                'popular_news' => $this->popular_news,
                'comments' => $this->comments,
                'social_medias' => $this->social_medias,
                'ads' => $this->ads,
                'square_ads' => $this->ads->where('size', '360x280')->where('status', 'Published'),
                'landscape_ads' => $this->ads->where('size', '850x200')->where('status', 'Published'),
            ]);
        });
    }
}
