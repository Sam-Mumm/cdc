<?php

class CategoryController extends \BaseController {

        public function getIndex($param = null)
        {
            if (!is_null($param))
            {
                $oCategories = Category::where('name','like',$param . '%')->paginate(50);
            }
            else
            {
                $oCategories = Category::paginate(50);
            }
            return View::make('_category.table')
                    ->with('categories',$oCategories);
        }
        
        public function postIndex($param = null)
        {
            if (!is_null($param))
            {
                $oCategories = Category::where('name','like',$param . '%')->get();
                return Response::json($oCategories,200);
            }
            return Response::json(array('msg'=>'call this never without parameter'),400);
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
                
        public function getDestroy($id)
	{
            $oCategory = Category::find($id);

            if(is_object($oCategory))
            {
                $oCategory->destroy($id);
                return Redirect::to('category')->with('message','category successfully deleted!');
            }
        }
}
