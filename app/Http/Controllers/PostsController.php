<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['all_posts', 'show']]);
    }

    /**
     * Display a listing of current users resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::orderBy('created_at', 'desc')->get();
        // $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $user = auth()->user();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Display a listing of all users resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_posts()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(isset(auth()->user()->paid))
        {
            return redirect('/dashboard')->with('error', 'Subscription payment incomplete.');
        }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset(auth()->user()->paid))
        {
            return redirect('/dashboard')->with('error', 'Subscription payment incomplete.');
        }

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', "Post was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Check if post exists before accessing
        if (!isset($post))
        {
            return redirect('/posts')->with('error', 'No Post Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if(isset(auth()->user()->paid))
        {
            return redirect('/dashboard')->with('error', 'Subscription payment incomplete.');
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = Post::find($id);

        //Check if post exists before accessing
        if (!isset($post))
        {
            return redirect('/posts')->with('error', 'No Post Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if(isset(auth()->user()->paid))
        {
            return redirect('/dashboard')->with('error', 'Subscription payment incomplete.');
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect("/posts/$post->id")->with('success', "Post was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //Check if post exists before accessing
        if (!isset($post))
        {
            return redirect('/posts')->with('error', 'No Post Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if(isset(auth()->user()->paid))
        {
            return redirect('/dashboard')->with('error', 'Subscription payment incomplete.');
        }

        $post->delete();

        return redirect('/posts/')->with('success', 'Post was successfully removed');
    }
}
