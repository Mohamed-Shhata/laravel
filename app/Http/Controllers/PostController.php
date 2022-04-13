<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
//    private $posts = [
//        ['id' => 1, 'title' => 'first post', 'posted_by' => 'ahmed', 'created_at' => '2022-04-11'],
//        ['id' => 2, 'title' => 'second post', 'posted_by' => 'mohamed', 'created_at' => '2022-04-11'],
//    ];
    public function index()
    {
        $postsFromDB = Post::all();
        // dd($postsFromD);

       return view('posts.index',['allPosts'=>$postsFromDB]);


    }

    public function create()
    {
        $users = User::all();
        return view('posts.create',['users'=>$users]);
    }

    public function store()
    {
        
        $postData=request()->all();
        // dd($postData);
        Post::create([
            'title' => $postData['title'],
            'discription' => $postData['discription'],
            'created_at' => $postData['createdat'],
        ]);
       
        $posts = Post::all();

         return view('posts.index',['allPosts' => $posts]);



    }

    public function show($post)
    {
        
        $post1 = Post::where('id', $post)->first();
       
        // dd($dbPost2);
        return view('posts.show',[
            'post'=>$post1,
        ]);
    }

    public function edit($id){

        $post = Post::where('id', $id)->first();
        $users = User::all();
    //    dd($post);

        return view('posts.edit',[
            'post'=>$post,
            'users'=>$users,
        ]);
    }

    public function update($id,Request $request){

        $post=$request->all();
        // dd($post);
        Post::where('id', $id)
        ->update([
            'title' => $post['title'],
            'discription' => $post['discription'],
            // 'posted_by' => $post['postedby'],
            'created_at' => $post['created_at'],
            
        ]);

        $posts = Post::all();

        return view('posts.index',['allPosts' => $posts]);

    }


    public function destroy ($id){

        $post = Post::where('id', $id);
        $post->delete();
        $posts = Post::all();

       return view('posts.index',['allPosts' => $posts]);

       }
}

