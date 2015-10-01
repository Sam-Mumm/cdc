<?php

class AlbumController extends \BaseController {

        public function getIndex($param = null)
        {
            if (!is_null($param))
            {
                $oAlbums = Album::where('title','like',$param . '%')->paginate(50);
            }
            else
            {
//                $oAlbums = Album::paginate(50);
                $oAlbums = Album::all();                
            }
            return View::make('_album.table')
                    ->with('albums',$oAlbums);
        }
        
        public function postIndex($param = null)
        {
            if (!is_null($param))
            {
                $oRessources = Ressource::where('name','like',$param . '%')->get();
                return Response::json($oRessources,200);
            }
            return Response::json(array('msg'=>'call this never without parameter'),400);
        }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
            $oArtist = Artist::selectRaw('CONCAT(first_name, " ", last_name) AS full_name, id')->lists('full_name', 'id');
            $oRessource = Ressource::lists('name', 'id');
            $oGenre = Genre::lists('name', 'id');
            $oCategory = Category::all();
            
            return View::make('_album.create')
                                ->with('artist', $oArtist)
                                ->with('ressource', $oRessource)
                                ->with('genre', $oGenre)
                                ->with('category', $oCategory);

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
	public function postDestroy($id)
        {
            $oAlbum = Album::find($id);

            if(is_object($oAlbum))
            {
                $oAlbum->destroy($id);
                return Redirect::to('album')->with('message','album successfully deleted!');
            }
	}


}
