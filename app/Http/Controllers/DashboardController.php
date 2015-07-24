<?php namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Video;
use App\Review;
use App\Article;
use App\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $articles = Article::orderBy('updated_at', 'desc')->take(6)->get();
        $videos = Video::orderBy('updated_at', 'desc')->take(6)->get();
        $posts = Post::orderBy('updated_at', 'desc')->take(6)->get();

        $c_articles = Article::count();
        $c_videos = Video::count();
        $c_posts = Post::count();
        $c_users = User::count();
        $c_reviews = Review::count();
        $c_comments = Comment::count();

		return view('dashboard', compact('articles', 'videos', 'posts',
                                         'c_articles', 'c_videos', 'c_posts',
                                         'c_users', 'c_reviews', 'c_comments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
