<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;

class BlogController extends Controller
{
    public function blog_post(Request $request): \Illuminate\Http\JsonResponse
{
        $validateUser = Validator::make($request->all(),
        [
            'blog_title' => 'required',
            'blog_desc' => 'required|min:20',
            'blog_picture' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $image = $request->file('blog_picture');
        $imageName = time().'.'.$image->extension();
        $imageName = str_replace(' ', '-', $imageName);
        $request->file('blog_picture')->move('uploads', $imageName);
        $user_id = $request->session()->get('user_id');

        $user = Blog::create([
            'user_id' => $user_id,
            'blog_id' => rand(00000,99999),
            'blog_title' => $request->blog_title,
            'blog_desc' => $request->blog_desc,
            'blog_picture' => $imageName,
            'blog_status' => "1",
        ], 201);

        return response()->json([
            'status' => true,
            'message' => 'Blog Published Successfully',
        ], 200);

}

    public function all_post(){
        $posts = Blog::orderBy('created_at', 'desc')->get();
        return response()->json($posts, status: 200);
    }

    public function get_post($id) {
        $post = Blog::where('blog_id',$id)->get();
        return response()->json($post);
    }

    public function edit_post(Request $request, $id): \Illuminate\Http\JsonResponse
{
        $validateUser = Validator::make($request->all(),
        [
            'blog_title' => 'required',
            'blog_desc' => 'required|min:20',
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }
        if($request->file('blog_picture')){
            $image = $request->file('blog_picture');
            $imageName = time().'.'.$image->extension();
            $imageName = str_replace(' ', '-', $imageName);
            $request->file('blog_picture')->move('uploads', $imageName);
            $user_id = $request->session()->get('user_id');

            $post = DB::table('blogs')
                ->where('blog_id', $id)
                ->update([
                    'blog_title' => $request->blog_title,
                    'blog_desc' => $request->blog_desc,
                    'blog_picture' => $imageName,
            ], 201);
            
        }else{
            $post = DB::table('blogs')
                ->where('blog_id', $id)
                ->update([
                    'blog_title' => $request->blog_title,
                    'blog_desc' => $request->blog_desc,
            ], 201);
        }

        

        return response()->json([
            'status' => true,
            'message' => 'Blog Post Edited Successfully',
        ], 200);

}

public function delete_post($id) {
    $post = Blog::where('blog_id',$id);
    $post->delete();
    return response()->json([
        'message'=>'Blog Post Deleted Successfully!!'
    ]);
}

}
