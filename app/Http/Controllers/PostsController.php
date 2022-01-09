<?php

namespace App\Http\Controllers;
use App\Post;
use App\PostReport;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Auth;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

public function index()
{
    $users=auth()->user()->following()->pluck('profiles.user_id');
    $posts=Post::whereIn('user_id', $users)->with('user')->latest()->paginate(4);
        return view('posts.index',compact('posts'));
}


    public function create()
    {
      return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);


        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }
    
    public function reportPost ($post, Request $request)
    {

        $data = request()->validate([
            'details' => 'required',

        ]);
        $user_id = Auth::user()->id;
       PostReport::create([
           "user_id"=>$user_id,
           "post_id"=>$post,
           "details"=>$request->details
       ]);

        return redirect('/');
    }
public function edit(\App\Post $post, Request $request, $id)
    {
        $post=Post::find($id);
        return view('posts.edit',compact('post'));
    }


    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $data = request()->validate([
            'caption' => 'required',
            'image' => '',
        ]);
        $post->update(array_merge(
            $data,

        ));

        return redirect('/profile/' . auth()->user()->id);
    }


    public  function  show(\App\Post $post){

        return view('posts.show',compact('post'));
    }

    public function destroy($id){

        $post = post::find($id);
        $post->delete();
        return redirect('/profile/' . auth()->user()->id);
    }
}
