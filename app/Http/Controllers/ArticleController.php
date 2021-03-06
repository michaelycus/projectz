<?php namespace App\Http\Controllers;

use DB;
use Input;
use App\Article;
use App\User;
use App\Http\Requests;
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
            $admins = User::admin(\App\Permission::ARTICLE_MANAGE)->orderBy(DB::raw('RAND()'))->get();

            $c_editing = Article::where('status', Article::STATUS_EDITING)->count();
            $c_proofreading = Article::where('status', Article::STATUS_PROOFREADING)->count();
            $c_scheduled = Article::where('status', Article::STATUS_SCHEDULED)->count();
            $c_published = Article::where('status', Article::STATUS_PUBLISHED)->count();

            $articles = Article::latest('updated_at')->take(8)->get();

            return view('medias.articles.overview', compact('admins', 'articles',
                                                            'c_editing', 'c_proofreading',
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
        $users = User::get()->lists('full_name', 'id');
		
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