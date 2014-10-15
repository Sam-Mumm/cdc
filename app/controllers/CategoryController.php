<?php

class CategoryController extends \BaseController {

        public function anyIndex($param = null)
        {
            if (!is_null($param))
            {
                $oCategories = Category::where('name','like',$param . '%')->paginate(50);
            }
            else
            {
//                $oGenres = Genre::paginate(50);
                $oCategories = Category::all();                
            }
            
            if (Request::ajax())
            {
                return Response::json(array("data"=> $oCategories->toArray()));
            }
            else
            {
                $heads= array(array('data' => 'name', 'title'=>trans('messages.Category')),
                              array('data' => 'show_artist', 'title'=>trans('messages.show artist')));
/*		if ($oRessources->count() > 0) {
			$keys = array_keys($oRessources->first()->toArray());
                	foreach($keys as $key)
                	{
                       		$heads[] = array('data'=>$key,'title'=>ucfirst($key));
                	}
		}*/
                return View::make('_category.table')
                        ->with('categories',$oCategories)
			->with('tblHeads',$heads);
            }
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
        
        public function postUpdate($id)
        {
            $oCategory = Category::find($id);

            if(is_object($oCategory))
            {
                $validator = Validator::make(Input::all(), Category::$rules);
                
                if($validator->passes())
                {
                    $oCategory->name=Input::get('name');
                    $oCategory->show_artist=Input::get('show_artist');
                    $oCategory->save();
                    return Redirect::to('category')->with('message','category updated!');
                }
                else
                {
                    return Redirect::to('category/edit')->withErrors($validator)->withInput();                
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
