<?php
class RessourceController extends \BaseController
{
        public function getIndex($param = null)
        {
            if (!is_null($param))
            {
                $oRessources = Ressource::where('name','like',$param . '%')->paginate(50);
            }
            else
            {
                $oRessources = Ressource::paginate(50);
            }
            return View::make('_ressource.table')
                    ->with('ressources',$oRessources);
        }
        
        public function postIndex($param = null)
        {
            if (!is_null($param))
            {
                $oRessources = Ressource::where('name','like',$param . '%')->get();
                return Response::json($oRessources,200);
            }
            return Response::json(array('msg'=>'call this never without parameter'),400);
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
        
        public function getEdit($id)
        {
            $oRessource = Ressource::find($id);

            if(is_object($oRessource))
            {
                return View::make('_ressource.edit')->with('data', $oRessource);
            }        
        }
        
        public function postUpdate($id)
        {
            $oRessource = Ressource::find($id);

            if(is_object($oRessource))
            {
                $validator = Validator::make(Input::all(), Ressource::$rules);
                
                if($validator->passes())
                {
                    $oRessource->name=Input::get('medium');
                    $oRessource->save();
                    return Redirect::to('ressource')->with('message','ressource updated!');
                }
                else
                {
                    return Redirect::to('ressource/edit')->withErrors($validator)->withInput();                
                }
            }
        }
        
	public function getDestroy($id)
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
