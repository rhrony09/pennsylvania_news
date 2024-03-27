<?php

namespace App\Http\Controllers;

use App\Helpers\Reply;
use App\Http\Requests\PhotoGalleryStoreRequest;
use App\Models\Gallery;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoGalleryController extends Controller {
    public function index() {
        $data = [
            'galleries' => Gallery::latest()->paginate(16),
            'page_title' => 'Photo Gallery'
        ];
        return view('dashboard.photo-gallery.index', $data);
    }

    public function create() {
        return view('dashboard.photo-gallery.modal.create');
    }

    public function store(PhotoGalleryStoreRequest $request) {

        $extension = $request->image->getClientOriginalExtension();
        $image_name = uniqid() . '.' . $extension;
        $image_path = 'uploads/photo-gallery/' . $image_name;
        Image::make($request->image)->fit(800, 450)->save(public_path($image_path));

        Gallery::create([
            'image' => $image_name,
        ]);

        return Reply::success('Image added successfully.');
    }

    public function delete(Gallery $gallery) {
        $gallery->delete();
        unlink('uploads/photo-gallery/' . $gallery->image);
        return back()->with('success', 'Image deleted successfully.');
    }
}
