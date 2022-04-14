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
        $posts = Post::paginate(10);
        // dd($postsFromD);

       return view('posts.index',['allPosts'=>$posts]);


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
            'user_id'=>$postData['post_creator'],
        ]);
       
        $posts = Post::all();

         return view('posts.index',['allPosts' => $posts]);



    }

    public function show($post)
    {
        
        $post1 = Post::where('id', $post)->first();
       
        // dd($dbPost2);
        return view('posts.show',[
            'posts'=>$post1,
        ]);
    }

    public function edit($post){

        // $post = Post::where('id', $post)->first();
        $post = Post::findorfail($post);
        $users = User::all();
    //    dd($post);

        return view('posts.edit',[
            'post'=>$post,
            'users'=>$users,
        ]);
    }

    // public function update($id,Request $request){

    //     $post=$request->all();
    //     // dd($post);
    //     Post::where('id', $id)
    //     ->update([
    //         'title' => $post['title'],
    //         'discription' => $post['discription'],
    //         'user_id' => $post['post_creator'],
    //         'created_at' => $post['created_at'],
            
    //     ]);

    //     $posts = Post::all();

    //     return view('posts.index',['allPosts' => $posts]);

    // }
    public function update($post,Request $request){
        $postToUpdate = post::find($post);
        $postToUpdate->update([
            'title' => $request->title,
            'discription' => $request->discription,
            'created_at' => $request->created_at,
            'user_id' => $request->post_creator,
        ]);

        // return to_route('posts.index');
        return redirect()->route('posts.index');
        
    }


    public function destroy ($post){

        $postToDelete = Post::find($post);
        $postToDelete->delete();
        return redirect()->route('posts.index');
       }
}

