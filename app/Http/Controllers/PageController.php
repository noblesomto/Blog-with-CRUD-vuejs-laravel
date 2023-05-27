<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;

class PageController extends Controller
{
    public function index(){
        $posts = Blog::orderBy('created_at', 'desc')->get();
        return response()->json($posts, status: 200);
    }

    public function post_details($id) {
        $post = Blog::where('blog_id',$id)->get();
        return response()->json($post);
    }
}
