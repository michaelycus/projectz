<?php namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Comment;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;


// TODO - Utilizar scopes: https://laracasts.com/series/laravel-5-fundamentals/episodes/11

// TODO - Implementar update: https://laracasts.com/series/laravel-5-fundamentals/episodes/13


/**
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::latest()->unpublished()->get();

        return view('articles.index', compact('articles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{		 
  		$users = \DB::table('users')->orderBy('name', 'asc')->lists('name','id');
    	
    	return view('articles.create', compact('users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ArticleRequest $request)
	{
		Article::create($request->all());

		flash()->success('O artigo foi criado!')->important();

		return redirect('articles');
	}

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return Response
     */
    public function show(Article $article)
	{
		return view('articles.show',compact('article'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function edit($id)
	public function edit(Article $article)
	{
		$users = \DB::table('users')->orderBy('name', 'asc')->lists('name','id');
		
		return view('articles.edit', compact('article', 'users'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Article $article, ArticleRequest $request)
	{
		$article->update($request->all());

		return redirect('articles/'.$article->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Article $article)
	{
		$article->delete();

		flash()->success('O artigo foi deletado!');
		
		return redirect('articles');
	}
}