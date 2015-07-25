<?php

namespace App\Http\Controllers;

use DB;
use Input;
use App\Post;
use App\User;
use App\Http\Requests;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermission:'.\App\Permission::POST_EXECUTE,['except' => ['index']]);
        $this->middleware('checkPermission:'.\App\Permission::POST_CREATE,['only' => ['create','store','edit','update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Input::get('status')){
            $posts = Post::latest()->where('status', Input::get('status'))->paginate(6);

            return view('medias.posts.index', compact('posts'));
        }else {
            $admins = User::admin(\App\Permission::POST_MANAGE)->orderBy(DB::raw('RAND()'))->get();

            $c_suggested = Post::where('status', Post::STATUS_SUGGESTED)->count();
            $c_proofreading = Post::where('status', Post::STATUS_PROOFREADING)->count();
            $c_scheduled = Post::where('status', Post::STATUS_SCHEDULED)->count();
            $c_published = Post::where('status', Post::STATUS_PUBLISHED)->count();

            $posts = Post::latest('updated_at')->take(8)->get();

            return view('medias.posts.overview', compact('admins', 'posts',
                'c_suggested', 'c_proofreading',
                'c_scheduled', 'c_published'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::get()->lists('full_name', 'id');

        return view('medias.posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        flash()->success('O post foi criado!')->important();

        return redirect('posts/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Post $post)
    {
        return view('medias.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Post $post)
    {
        $users = User::get()->lists('full_name', 'id');

        return view('medias.posts.edit', compact('post', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Post $post, PostRequest $request)
    {
        $post->update($request->all());

        flash()->success('O post foi atualizado!')->important();

        return redirect('posts/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        flash()->success('O post foi deletado!');

        return redirect('posts');
    }
}
