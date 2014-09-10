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
//                $oArtists = Artist::paginate(50);
                $oArtists = Artist::paginate(50);
            }
            return View::make('_artist.table')
                    ->with('artists',$oArtists);
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

        public function getEdit($id)
        {
            $oArtist = Artist::find($id);

            if(is_object($oArtist))
            {
                return View::make('_artist.edit')->with('data', $oArtist);
            }        
        }
        
        public function postUpdate($id)
        {
            $oArtist = Artist::find($id);

            if(is_object($oArtist))
            {
                $validator = Validator::make(Input::all(), Artist::$rules);
                
                if($validator->passes())
                {
                    $oArtist->first_name=Input::get('first_name');
                    $oArtist->last_name=Input::get('last_name');
                    $oArtist->save();
                    return Redirect::to('artist')->with('message','artist updated!');
                }
                else
                {
                    return Redirect::to('artist/edit')->withErrors($validator)->withInput();                
                }
            }
        }
        
	public function postDestroy($id)
	{
            $oArtist = Artist::find($id);

            if(is_object($oArtist))
            {
                $oArtist->destroy($id);
                return Redirect::to('artist')->with('message','artist successfully deleted!');
            }
        }
}
?>
