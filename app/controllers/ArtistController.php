<?php
class ArtistController extends \BaseController
{
        public function anyIndex($param = null)
        {
            if (!is_null($param))
            {
                $oArtists = Artist::where('name','like',$param . '%')->paginate(50);
            }
            else
            {
//                $oArtists = Artist::paginate(50);
                $oArtists = Artist::all();                
            }
            
            if (Request::ajax())
            {
                return Response::json(array("data"=> $oArtists->toArray()));
            }
            else
            {
                $heads= array(array('data' => 'first_name', 'title'=>trans('messages.Given name/Article')),
                              array('data' => 'last_name', 'title'=>trans('messages.Last Name/Group')));
/*		if ($oRessources->count() > 0) {
			$keys = array_keys($oRessources->first()->toArray());
                	foreach($keys as $key)
                	{
                       		$heads[] = array('data'=>$key,'title'=>ucfirst($key));
                	}
		}*/
                return View::make('_artist.table')
                        ->with('artists',$oArtists)
			->with('tblHeads',$heads);
            }
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