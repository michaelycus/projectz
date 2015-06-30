<?php namespace App\Http\Controllers;

use App\User;
use App\Video;
use App\Comment;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use Input;

class VideoController extends Controller {

    public function __construct()
    {
        $this->middleware('checkPermission:'.PERMISSION_VIDEO_EXECUTE,['except' => ['index']]);
        $this->middleware('checkPermission:'.PERMISSION_VIDEO_CREATE,['only' => ['create','store','edit','update']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Input::get('status')){
            $videos = Video::where('status', Input::get('status'))->get();
        }else{
            $videos = Video::latest()->unpublished()->get();
        }

        return view('videos.index', compact('videos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = \DB::table('users')->orderBy('name', 'asc')->lists('name','id');

		return view('videos.create', compact('users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(VideoRequest $request)
	{
		Video::create(with(new Video)->handle($request->all()));

		flash()->success('O vídeo foi criado!')->important();

		return redirect('videos');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Video $video)
	{
		return view('videos.show',compact('video'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Video $video)
	{
		$users = \DB::table('users')->orderBy('name', 'asc')->lists('name','id');

		return view('videos.edit', compact('video', 'users'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Video $video, VideoRequest $request)
	{
		//$videos = Video::latest()->unpublished()->get();
		//$video->update(Video::handle($request->all()));
		$video->update(with(new Video)->handle($request->all()));

		flash()->success('O vídeo foi atualizado!');

		return redirect('videos/'.$video->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Video $video)
	{
		$video->delete();

		flash()->success('O vídeo foi deletado!');
		
		return redirect('videos');
	}
}
