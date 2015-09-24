<?php
class ArtistController extends \BaseController
{
        public function getData()
        {
            $data = Artist::getModel();
            
            if(Input::get('search.value') !== '')
            {
                $search = Input::get('search.value', '');
                $data = $data->where('first_name','LIKE',"%$search%")->orWhere('last_name','LIKE',"%$search%");
            }
            
            $start = Input::get('start', 0);
            $length = Input::get('length', 10);
            
            $filtered = $data->count();
            $data = $data->skip($start)->take($length);
            
            $data = $data->get()->toArray();
            $total = Artist::count();
            return [
                'draw' => Input::get('draw', 1),
                'recordsTotal' => $total,
                'recordsFiltered' => $filtered,
                'data' => $data
            ];
        }

        public function anyIndex($param = null)
        {
            $heads= array(array('data' => 'first_name', 'title'=>trans('messages.Given name/Article')),
                          array('data' => 'last_name', 'title'=>trans('messages.Last Name/Group')));

            return View::make('_artist.table')
                                ->with('tblHeads',$heads);
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
        
        public function postUpdate()
        {
            $oArtist = Artist::find(Input::get('pk'));
            
            if(is_object($oArtist))
            {
                if(Input::get('name')=='first_name')
                {
                    $oArtist->first_name=Input::get('value');
                    $oArtist->save();
                } 
                elseif (Input::get('name')=='last_name')
                {
                    if(!empty(Input::get('value')))
                    {
                        $oArtist->last_name=Input::get('value');
                        $oArtist->save();                        
                    }
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
