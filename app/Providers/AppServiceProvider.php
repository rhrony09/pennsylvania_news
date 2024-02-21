<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\News;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    public $settings;
    public $news_categories;
    public $latest_news;
    public $popular_news;

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
        view()->composer('*', function ($view) {
            $view->with([
                'settings' => $this->settings,
                'news_categories' => $this->news_categories,
                'latest_news' => $this->latest_news,
                'popular_news' => $this->popular_news,
            ]);
        });
    }
}
