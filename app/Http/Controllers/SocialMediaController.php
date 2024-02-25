<?php

namespace App\Http\Controllers;

use App\Helpers\Reply;
use App\Http\Requests\Settings\SocialMediaUpdateRequest;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller {
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (!in_array(auth()->user()->role->id, [1, 2])) {
                abort(403, 'Unauthorized.');
            } else {
                return $next($request);
            }
        });
    }

    public function index() {
        return view('dashboard.settings.social-media');
    }

    public function update(SocialMediaUpdateRequest $request) {
        foreach ($request->except('_token') as $key => $social_media) {
            SocialMedia::where('name', $key)->first()->update([
                'link' => $social_media,
            ]);
        }

        return Reply::success('Updated successfully.');
    }
}
