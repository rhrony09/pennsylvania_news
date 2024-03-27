<?php

namespace App\Http\Controllers;

use App\Helpers\Reply;
use App\Http\Requests\VideoGalleryStoreRequest;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class VideoGalleryController extends Controller {
    public function index() {
        $data = [
            'galleries' => VideoGallery::latest()->paginate(16),
            'page_title' => 'Video Gallery'
        ];
        return view('dashboard.video-gallery.index', $data);
    }

    public function create() {
        return view('dashboard.video-gallery.modal.create');
    }

    public function store(VideoGalleryStoreRequest $request) {
        $matches = '';
        preg_match(
            '/[\\?\\&]v=([^\\?\\&]+)/',
            $request->video_link,
            $matches
        );

        DB::beginTransaction();
        try {
            $video = VideoGallery::create([
                'title' => $request->title,
                'video_link' => $matches[1],
                'slug' => make_slug($request->title)
            ]);
            $extension = $request->thumbnail->getClientOriginalExtension();
            $image_name = $video->id . '-' . uniqid() . '.' . $extension;
            $image_path = 'uploads/video-gallery/' . $image_name;
            Image::make($request->thumbnail)->fit(800, 450)->save(public_path($image_path));

            $video->update([
                'thumbnail' => $image_name,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return Reply::error($e->getMessage());
        }

        return Reply::success('Video added successfully.');
    }

    public function delete(VideoGallery $gallery) {
        $gallery->delete();
        unlink('uploads/video-gallery/' . $gallery->thumbnail);
        return back()->with('success', 'Video deleted successfully.');
    }
}
