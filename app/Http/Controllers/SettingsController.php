<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settings\SettingsUpdateRequest;
use App\Models\Setting;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller {
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
        return view('dashboard.settings.index');
    }

    public function settings_update(SettingsUpdateRequest $request) {
        Setting::where('key', 'site_name')->update([
            'value' => $request->site_name,
        ]);
        Setting::where('key', 'site_tagline')->update([
            'value' => $request->site_tagline,
        ]);
        Setting::where('key', 'email')->update([
            'value' => $request->email,
        ]);
        Setting::where('key', 'phone')->update([
            'value' => $request->phone,
        ]);
        Setting::where('key', 'fax')->update([
            'value' => $request->fax,
        ]);
        Setting::where('key', 'address')->update([
            'value' => $request->address,
        ]);
        Setting::where('key', 'map_link')->update([
            'value' => $request->map_link,
        ]);
        Setting::where('key', 'chief_editor')->update([
            'value' => $request->chief_editor,
        ]);
        Setting::where('key', 'editor_publisher')->update([
            'value' => $request->editor_publisher,
        ]);
        Setting::where('key', 'site_primary_color')->update([
            'value' => $request->site_primary_color,
        ]);
        Setting::where('key', 'site_accent_color')->update([
            'value' => $request->site_accent_color,
        ]);
        Setting::where('key', 'site_secondary_color')->update([
            'value' => $request->site_secondary_color,
        ]);
        Setting::where('key', 'site_secondary_accent_color')->update([
            'value' => $request->site_secondary_accent_color,
        ]);
        //dark logo
        if ($request->hasFile('logo_dark')) {
            $image = $request->file('logo_dark');
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid() . '.' . $extension;
            $image_path = 'uploads/logos/' . $image_name;
            $file = Setting::where('key', 'logo_dark')->first();
            if ($extension == 'svg') {
                if (File::exists(public_path('/uploads/logos/' . $file->value))) {
                    File::delete(public_path('/uploads/logos/' . $file->value));
                }
                Storage::disk('uploads')->put($image_path, file_get_contents($image));
            } else {
                if (File::exists(public_path('/uploads/logos/' . $file->value))) {
                    File::delete(public_path('/uploads/logos/' . $file->value));
                }
                Image::make($image)->save(public_path($image_path));
            }
            $file->update([
                'value' => $image_name,
            ]);
        }
        //light logo
        if ($request->hasFile('logo_light')) {
            $image = $request->file('logo_light');
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid() . '.' . $extension;
            $image_path = 'uploads/logos/' . $image_name;
            $file = Setting::where('key', 'logo_light')->first();
            if ($extension == 'svg') {
                if (File::exists(public_path('/uploads/logos/' . $file->value))) {
                    File::delete(public_path('/uploads/logos/' . $file->value));
                }
                Storage::disk('uploads')->put($image_path, file_get_contents($image));
            } else {
                if (File::exists(public_path('/uploads/logos/' . $file->value))) {
                    File::delete(public_path('/uploads/logos/' . $file->value));
                }
                Image::make($image)->save(public_path($image_path));
            }
            $file->update([
                'value' => $image_name,
            ]);
        }
        //favicon
        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $file_name = Setting::where('key', 'favicon')->first();
            if (File::exists(public_path('/uploads/logos/' . $file_name->value))) {
                File::delete(public_path('/uploads/logos/' . $file_name->value));
            }
            Image::make($image)->fit('90', '90')->save(public_path('/uploads/logos/' . $file_name->value));
        }
        session()->flash('success', 'Setting Updated successfully!');
        return response()->json(['success' => true]);
    }
}
