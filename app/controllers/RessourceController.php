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
            return View::make('_common.table')
                    ->with('datas',$oRessources);
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
            return Response::json($oRessource,200);
        }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate()
	{
            $ressource = Ressource::find(Input::post('id'));

            if(is_object($ressource))
            {                    
                $validator = validator::make(Input::post(name), Ressource::$rules);

                if($validator->passes())
                {   
                    $ressource->name=$name;
                    $ressource->save();
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
            $ressource = Ressource::find(Input::post('id'));

            if(is_object($ressource))
            {
                $ressource->destroy();
            }
        }
}
?>
