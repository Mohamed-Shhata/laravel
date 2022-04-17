<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

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
        // dd($posts);

       return view('posts.index',['allPosts'=>$posts]);


    }

    public function create()
    {
        $users = User::all();
        return view('posts.create',['users'=>$users]);
    }

    public function store(StorePostRequest $request)
    {
        // dd(request()->all());
        
        
        $postData=request()->all();
        $slug = SlugService::createSlug(Post::class, 'slug', $postData['title']);
        
        $path = Storage::putFile('public', request()->file('image'));
        // dd($path);
        $url = Storage::url($path);
        // dd($postData);
        // dd($slug);
       
        Post::create([
            'title' => $postData['title'],
            'discription' => $postData['discription'],
            'created_at' => $postData['createdat'],
            'user_id'=>$postData['post_creator'],
            'slug' => $slug,
            'image_path' => $url,
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
        $post = Post::findOrFail($post);
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
    public function update($post,UpdatePostRequest $request){
        $postToUpdate = post::findOrFail($post);
        $data=request()->all();
        $path = Storage::putFile('public', request()->file('image'));
        $url = Storage::url($path);
        $slug = SlugService::createSlug(Post::class, 'slug', $postToUpdate['title']);
        $postToUpdate->update([
            'title' => $request->title,
            'discription' => $request->discription,
            'created_at' => $request->created_at,
            'user_id' => $request->post_creator,
            'slug' => $slug,
            'image_path' => $url,
        ]);

        // return to_route('posts.index');
        return redirect()->route('posts.index');
        
    }


    public function destroy ($post){

        $postToDelete = Post::findOrFail($post);
        $location =  $singlePost->image_path;
        $imageName = basename($location);

        $imageURL = "images" . '\\' . $imageName;
        unlink($imageURL);
        $postToDelete->Comments()->delete();
        $postToDelete->delete();
        return redirect()->route('posts.index');
       }
}

