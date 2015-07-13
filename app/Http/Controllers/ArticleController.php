<?php namespace App\Http\Controllers;

use Input;
use App\Article;
use App\User;
use App\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;


/**
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermission:'.\App\Permission::ARTICLE_EXECUTE,['except' => ['index']]);
        $this->middleware('checkPermission:'.\App\Permission::ARTICLE_CREATE,['only' => ['create','store','edit','update']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Input::get('status')){
            $articles = Article::latest()->where('status', Input::get('status'))->paginate(10);

            return view('medias.articles.index', compact('articles'));
        }else{
            return view('medias.articles.overview');
        }
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{		 
  		$users = \DB::table('users')->orderBy('name', 'asc')->lists('name','id');
    	
    	return view('medias.articles.create', compact('users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ArticleRequest $request)
	{
		$article = Article::create($request->all());

		flash()->success('O artigo foi criado!')->important();

		return redirect('articles/'.$article->id);
	}

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return Response
     */
    public function show(Article $article)
	{
		return view('medias.articles.show',compact('article'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Article $article)
	{
		$users = \DB::table('users')->orderBy('name', 'asc')->lists('name','id');
		
		return view('medias.articles.edit', compact('article', 'users'));
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

        flash()->success('O artigo foi atualizado!')->important();

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