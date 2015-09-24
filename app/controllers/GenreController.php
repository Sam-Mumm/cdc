<?php

class GenreController extends \BaseController
{
        public function getData()
        {
            $data = Genre::getModel();
            
            if(Input::get('search.value') !== '' )
            {
                $search = Input::get('search.value', '');
                $data = $data->where('name', 'LIKE', "%$search%");
            }
            
            $start = Input::get('start',0);
            $length = Input::get('length',10);

            $filtered = $data->count();
            $data = $data->skip($start)->take($length);

            $data = $data->get()->toArray();
            $total = Genre::count();
            
            return [
                'draw' => Input::get('draw',1),
                'recordsTotal' => $total,
                'recordsFiltered' => $filtered,
                'data' => $data
            ];
        }

        public function anyIndex($param = null)
        {
            $heads= array(array('data' => 'name', 'title'=>trans('messages.Genre')));

            return View::make('_genre.table')
                               ->with('tblHeads',$heads);
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
