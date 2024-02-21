<?php

namespace App\Http\Controllers;

use App\Helpers\Reply;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
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
        $data = [
            'categories' => Category::all(),
        ];
        return view('dashboard.category.index', $data);
    }

    public function store(CategoryStoreRequest $request) {
        $slug = make_slug($request->slug);
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return Reply::success('Category addedd successfully.');
    }

    public function edit($id) {
        $data = [
            'category' => Category::find($id),
        ];
        return view('dashboard.category.modal.edit', $data);
    }

    public function update(CategoryUpdateRequest $request) {
        $slug = make_slug($request->slug);
        Category::find($request->id)->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return Reply::success('Category updated successfully.');
    }

    public function delete(Category $id) {
        $id->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
