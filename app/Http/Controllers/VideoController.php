<?php namespace App\Http\Controllers;

use DB;
use Input;
use App\User;
use App\Video;
use App\Http\Requests;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller {

    public function __construct()
    {
        $this->middleware('checkPermission:'.\App\Permission::VIDEO_EXECUTE,['except' => ['index']]);
        $this->middleware('checkPermission:'.\App\Permission::VIDEO_CREATE,['only' => ['create','store','edit','update']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Input::get('status')){
            $videos = Video::latest()->where('status', Input::get('status'))->paginate(10);

            return view('medias.videos.index', compact('videos'));
        }else{
            $admins = User::admin(\App\Permission::VIDEO_MANAGE)->orderBy(DB::raw('RAND()'))->get();

            $c_transcription = Video::where('status', Video::STATUS_TRANSCRIPTION)->count();
            $c_synchronization = Video::where('status', Video::STATUS_SYNCHRONIZATION)->count();
            $c_translation = Video::where('status', Video::STATUS_TRANSLATION)->count();
            $c_proofreading = Video::where('status', Video::STATUS_PROOFREADING)->count();
            $c_scheduled = Video::where('status', Video::STATUS_SCHEDULED)->count();
            $c_published = Video::where('status', Video::STATUS_PUBLISHED)->count();

            $videos = Video::latest('updated_at')->take(8)->get();

            return view('medias.videos.overview', compact('admins', 'videos',
                'c_transcription', 'c_synchronization',
                'c_translation', 'c_proofreading',
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

		return view('medias.videos.create', compact('users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(VideoRequest $request)
	{
		$video = Video::create(with(new Video)->handle($request->all()));

		flash()->success('O vídeo foi criado!')->important();

		return redirect('videos/'.$video->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Video $video)
	{
		return view('medias.videos.show',compact('video'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Video $video)
	{
        $users = User::get()->lists('full_name', 'id');

		return view('medias.videos.edit', compact('video', 'users'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Video $video, VideoRequest $request)
	{
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
