<?php

class CategoryController extends \BaseController
{
        public function getData()
        {
            $data = Category::getModel();
            
            if(Input::get('search.value') !== '' )
            {
                $search = Input::get('search.value', '');
                $data = $data->where('name', 'LIKE', "%$search%");
            }
            
            $start = Input::get('start', 0);
            $length = Input::get('length', 10);
            
            $filtered = $data->count();
            $data = $data->skip($start)->take($length);
            
            $data = $data->get()->toArray();
            $total = Category::count();
            
            return [
                'draw' => Input::get('draw',1),
                'recordsTotal' => $total,
                'recordsFiltered' => $filtered,
                'data' => $data
            ];
        }
    
        public function anyIndex($param = null)
        {
           $heads= array(array('data' => 'name', 'title'=>trans('messages.Category')),
                         array('data' => 'show_artist', 'title'=>trans('messages.show artist')));

           return View::make('_category.table')
			->with('tblHeads',$heads);
        }
        
        public function getCreate()
        {
            return View::make('_category.create');            
        }
                
        public function postStore()
        {
            $validator = Validator::make(Input::all(), Category::$rules);

            if($validator->passes())
            {
                $oCategory = new Category();
                $oCategory->name=Input::get('name');
                $oCategory->show_artist=Input::get('show_artist');
                $oCategory->save();
                return Redirect::to('category')->with('message','new category created!');
            }
            else
            {
                return Redirect::to('category/create')->withErrors($validator)->withInput();                
            }
        }
        
        public function getEdit($id)
        {
            $oCategory = Category::find($id);

            if(is_object($oCategory))
            {
                return View::make('_category.edit')->with('data',$oCategory);
            }        
        }
        
        public function postUpdate()
        {
            $oCategory = Category::find(Input::get('pk'));

            if(is_object($oCategory))
            {
                if(Input::get('name')=='name')
                {
                    $oCategory->name=Input::get('value');
                    $oCategory->save();                   
                }
                elseif (Input::get('name')=='show_artist')
                {
                    $oCategory->show_artist=Input::get('value');
                    $oCategory->save();
                }
            }
        }
                
        public function postDestroy($id)
	{
            $oCategory = Category::find($id);

            if(is_object($oCategory))
            {
                $oCategory->destroy($id);
                return Redirect::to('category')->with('message','category successfully deleted!');
            }
        }
}
