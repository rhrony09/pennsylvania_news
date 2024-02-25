<?php

namespace App\Http\Controllers;

use App\Helpers\Reply;
use App\Http\Requests\Ads\AdsStoreRequest;
use App\Http\Requests\Ads\AdsUpdateRequest;
use App\Models\Ad;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdController extends Controller {
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
        return view('dashboard.ads.index');
    }

    public function create() {
        return view('dashboard.ads.modal.create');
    }

    public function store(AdsStoreRequest $request) {
        DB::beginTransaction();
        try {
            $ad = Ad::create([
                'size' => $request->size,
            ]);

            $size = explode('x', $request->size);

            if ($request->has('image')) {
                $extension = $request->image->getClientOriginalExtension();
                $image_name = $ad->id . '-' . uniqid() . '.' . $extension;
                $image_path = 'uploads/ads/' . $image_name;
                Image::make($request->image)->fit($size[0], $size[1])->save(public_path($image_path));

                $ad->update([
                    'image' => $image_name,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return Reply::error($e->getMessage());
        }

        return Reply::success('Ad published successfully.');
    }

    public function show(Ad $ad) {
        $data = [
            'ad' => $ad,
        ];
        return view('dashboard.ads.modal.show', $data);
    }

    public function edit(Ad $ad) {
        $data = [
            'ad' => $ad,
        ];
        return view('dashboard.ads.modal.edit', $data);
    }

    public function update(AdsUpdateRequest $request) {

        $ad = Ad::find($request->id);

        $size = explode('x', $ad->size);

        if ($request->has('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $image_name = $ad->id . '-' . uniqid() . '.' . $extension;
            $image_path = 'uploads/ads/' . $image_name;
            unlink('uploads/ads/' . $ad->image);
            Image::make($request->image)->fit($size[0], $size[1])->save(public_path($image_path));

            $ad->update([
                'image' => $image_name,
            ]);
        }

        return Reply::success('Ad updated successfully.');
    }

    public function delete(Ad $ad) {
        $ad->delete();
        unlink('uploads/ads/' . $ad->image);
        return back()->with('success', 'Ad deleted successfully.');
    }

    public function status_change(Request $request) {
        $comment = Ad::find($request->id);
        $comment->status = $request->status;
        $comment->save();
        return Reply::success('Status updated successfully.');
    }
}
