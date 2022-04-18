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
        $imageName = time().'.'.$request->image->extension();
        
        $postData=request()->all();
        $slug = SlugService::createSlug(Post::class, 'slug', $postData['title']);
       
        Post::create([
            'title' => $postData['title'],
            'discription' => $postData['discription'],
            'created_at' => $postData['createdat'],
            'user_id'=>$postData['post_creator'],
            'slug' => $slug,
            'image_path' => $imageName,
        ]);
       
        $posts = Post::all();
        $request->image->move(public_path('image'), $imageName);

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

    
    public function update($post,UpdatePostRequest $request){
        $imageName = time().'.'.$request->image->extension();
        // dd($imageName);
        $postToUpdate = post::findOrFail($post);
        $data=request()->all();
        // $path = Storage::putFile('public', request()->file('image'));
        // $url = Storage::url($path);

        $slug = SlugService::createSlug(Post::class, 'slug', $postToUpdate['title']);
        $postToUpdate->update([
            'title' => $request->title,
            'discription' => $request->discription,
            'created_at' => $request->created_at,
            'user_id' => $request->post_creator,
            'slug' => $slug,
            'image_path' => $imageName,
        ]);
        $request->image->move(public_path('image'), $imageName);
        // return to_route('posts.index');
        return redirect()->route('posts.index');
        
    }


    public function destroy ($post){

        $postToDelete = Post::findOrFail($post);
        $location =  $postToDelete->image_path;
        $imageName = basename($location);

        $imageURL = "image" . '\\' . $imageName;
        unlink($imageURL);
        $postToDelete->Comments()->delete();
        $postToDelete->delete();
        return redirect()->route('posts.index');
       }
}

