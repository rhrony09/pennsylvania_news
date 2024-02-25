<?php

namespace App\Http\Controllers;

use App\Helpers\Reply;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller {
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
        return view('dashboard.comments.index');
    }

    public function  status_change(Request $request) {
        $comment = Comment::find($request->id);
        $comment->status = $request->status;
        $comment->save();
        return Reply::success('Status updated successfully.');
    }

    public function delete(Comment $comment) {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully.');
    }
}
