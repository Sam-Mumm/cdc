<?php
class RessourceController extends \BaseController
{
        public function anyIndex($param = null)
        {
            if (!is_null($param))
            {
                $oRessources = Ressource::where('medium','like',$param . '%')->paginate(50);
            }
            else
            {
                $oRessources = Ressource::all();
            }


            if (Request::ajax())
            {
                return Response::json(array("data"=> $oRessources->toArray()));
            }
            else
            {
                $heads= array(array('data' => 'name', 'title'=>trans('messages.Medium')));
/*		if ($oRessources->count() > 0) {
			$keys = array_keys($oRessources->first()->toArray());
                	foreach($keys as $key)
                	{
                       		$heads[] = array('data'=>$key,'title'=>ucfirst($key));
                	}
		}*/
                return View::make('_ressource.table')
                        ->with('ressources',$oRessources)
			->with('tblHeads',$heads);
            }
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
