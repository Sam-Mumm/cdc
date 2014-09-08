<?php
class ArtistController extends \BaseController
{
        public function getIndex($param = null)
        {
            if (!is_null($param))
            {
                $oArtists = Artist::where('name','like',$param . '%')->paginate(50);
            }
            else
            {
                $oArtists = Artist::paginate(50);
            }
            return View::make('_common.table')
                    ->with('datas',$oArtists);
        }
        
        public function postIndex($param = null)
        {
            if (!is_null($param))
            {
                $oArtists = Artist::where('name','like',$param . '%')->get();
                return Response::json($oArtists,200);
            }
            return Response::json(array('msg'=>'call this never without parameter'),400);
        }
        
        public function getEdit($id)
        {
            $oArtist = Artist::find($id);
            return Response::json($oArtist,200);
        }

        public function getCreate()
        {
            return View::make('_artist.create');            
        }   
        
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
            $validator = Validator::make(Input::all(), Artist::$rules);

            if($validator->passes())
            {
                $oArtist=new Artist();
                $oArtist->first_name=Input::get('first_name');
                $oArtist->last_name=Input::get('last_name');
                $oArtist->save();
                return Redirect::to('artist')->with('message','new artist created!');
            }
            else
            {
                return Redirect::to('artist/create')->withErrors($validator)->withInput();                
            }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate()
	{
            $artist = Artist::find(Input::post('id'));

            if(is_object($artist))
            {                    
                $validator = validator::make(Input::post(name), Artist::$rules);

                if($validator->passes())
                {   
                    $artist->name=$name;
                    $artist->save();
                }
            }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy($id)
	{
            $artist = Artist::find(Input::post('id'));

            if(is_object($artist))
            {
                $artist->destroy();
            }
        }
}
?>
