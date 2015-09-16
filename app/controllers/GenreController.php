<?php

class GenreController extends \BaseController
{
        public function anyIndex($param = null)
        {
            if (!is_null($param))
            {
                $oGenres = Genre::where('name','like',$param . '%')->paginate(50);
            }
            else
            {
//                $oGenres = Genre::paginate(50);
                $oGenres = Genre::all();                
            }
            
            if (Request::ajax())
            {
                return Response::json(array("data"=> $oGenres->toArray()));
            }
            else
            {
                $heads= array(array('data' => 'name', 'title'=>trans('messages.Genre')));

                return View::make('_genre.table')
                        ->with('genres',$oGenres)
			->with('tblHeads',$heads);
            }
        }

        public function getCreate()
        {
            return View::make('_genre.create');            
        }
        
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
            $validator = Validator::make(Input::all(), Genre::$rules);

            if($validator->passes())
            {
                $oGenre=new Genre();
                $oGenre->name=Input::get('name');
                $oGenre->save();
                return Redirect::to('genre')->with('message','new genre created!');
            }
            else
            {
                return Redirect::to('genre/create')->withErrors($validator)->withInput();                
            }
	}
       
        public function postUpdate()
        {
            $oGenre = Genre::find(Input::get('pk'));

            if(is_object($oGenre))
            {
                $validator = Validator::make(Input::all(), Genre::$rules);
                
                if($validator->passes())
                {
                    $oGenre->name=Input::get('value');
                    $oGenre->save();           
                }
            }
        }
        
        
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function anyDestroy($id)
	{
            $oGenre = Genre::find($id);

            if(is_object($oGenre))
            {
                $oGenre->destroy($id);
                return Redirect::to('genre')->with('message','genre successfully deleted!');
            }
        }
}
?>
