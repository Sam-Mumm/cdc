<?php
class RessourceController extends \BaseController
{
        public function getData()
        {
            $data = Ressource::getModel();
            
            if(Input::get('search.value') !== '')
            {
                $search = Input::get('search.value', '');
                $data = $data->where('name', 'LIKE', "%$search%");
            }
            
            $start = Input::get('start', 0);
            $length = Input::get('length', 10);
            
            $filtered = $data->count();
            $data = $data->skip($start)->take($length);
            
            $data = $data->get()->toArray();
            $total = Ressource::count();
            
            return [
                'draw' => Input::get('draw', 1),
                'recordsTotal' => $total,
                'recordsFiltered' => $filtered,
                'data' => $data
            ];
        }


        public function anyIndex($param = null)
        {
            $heads= array(array('data' => 'name', 'title'=>trans('messages.Medium')));

            return View::make('_ressource.table')
                              ->with('tblHeads',$heads);
        }
        
        public function getCreate()
        {
            return View::make('_ressource.create');            
        }

        public function postStore()
	{
            $validator = Validator::make(Input::all(), Ressource::$rules);

            if($validator->passes())
            {
                $oRessource=new Ressource();
                $oRessource->name=Input::get('medium');
                $oRessource->save();
                return Redirect::to('ressource')->with('message','new Medium created!');
            }
            else
            {
                return Redirect::to('ressource/create')->withErrors($validator)->withInput();                
            }
	}
        
        public function postUpdate()
        {
            $oRessource = Ressource::find(Input::get('pk'));
            if(is_object($oRessource))
            {
                $validator = Validator::make(Input::all(), Ressource::$rules);
                
                if($validator->passes())
                {
                    $oRessource->name=Input::get('value');
                    $oRessource->save();
                }
            }
        }
        
	public function anyDestroy($id)
	{
            $oRessource = Ressource::find($id);

            if(is_object($oRessource))
            {
                $oRessource->destroy($id);
                return Redirect::to('ressource')->with('message','ressource successfully deleted!');
            }
        }
        
}
?>
