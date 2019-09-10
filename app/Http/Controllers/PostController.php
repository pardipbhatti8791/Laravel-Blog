<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\BlogPost;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // DB::connection()->enableQueryLog();

        // $posts = BlogPost::withCount('comments')->get();
        // foreach ($posts as $post) {
        //     foreach ($post->comments as $comment) {
        //         echo $comment->content;
        //     }
        // }
        // dd(DB::getQueryLog());
        return view(
            'posts.index',
            ['posts' => BlogPost::withCount('comments')->get()]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePost $request)
    {
        $validatedData = $request->validated();
        $blogPost = BlogPost::create($validatedData);

        $request->session()->flash('status', 'Blog post was create!');
        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        return view('posts.show', ['post' => BlogPost::with('comments')->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        if (Gate::denies('update-post', $post)) {
            abort(403, 'You cannot edit this post');
        }
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\StorePost $request, $id)
    {

        $post = BlogPost::findOrFail($id);

        if (Gate::denies('update-post', $post)) {
            abort(403, 'You cannot edit this post');
        }

        $validatedData = $request->validated();

        $post->fill($validatedData);
        $post->save();
        $request->session()->flash('status', 'Blog post was updated!');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize('update-post', $post);
        $post->delete();
        $request->session()->flash('status', 'Blog post was deleted!');
        return redirect()->route('posts.index');
    }
}
