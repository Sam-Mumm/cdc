<?php

class GenreController extends \BaseController
{
        public function getIndex($param = null)
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
            return View::make('_genre.table')
                    ->with('genres',$oGenres);
        }
        
        public function postIndex($param = null)
        {
            if (!is_null($param))
            {
                $oGenres = Genre::where('name','like',$param . '%')->get();
                return Response::json($oGenres,200);
            }
            return Response::json(array('msg'=>'call this never without parameter'),400);
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

        public function getEdit($id)
        {
            $oGenre = Genre::find($id);

            if(is_object($oGenre))
            {
                return View::make('_genre.edit')->with('data',$oGenre);
            }        
        }
        
        public function postUpdate($id)
        {
            $oGenre = Genre::find($id);

            if(is_object($oGenre))
            {
                $validator = Validator::make(Input::all(), Genre::$rules);
                
                if($validator->passes())
                {
                    $oGenre->name=Input::get('name');
                    $oGenre->save();
                    return Redirect::to('genre')->with('message','genre updated!');
                }
                else
                {
                    return Redirect::to('genre/edit')->withErrors($validator)->withInput();                
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
            $oGenre = Genre::find($id);

            if(is_object($oGenre))
            {
                $oGenre->destroy($id);
                return Redirect::to('genre')->with('message','genre successfully deleted!');
            }
        }
}
?>
