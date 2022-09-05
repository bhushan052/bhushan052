<?php

namespace App\Http\Controllers;

use App\Models\Treeentry;
use App\Models\TreeEntryLang;
use Illuminate\Http\Request;

class ViewTreeController extends Controller
{

    private $parentKey = '0';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

    }

    /**
     * Display a listing of the tree results.
     *
     * @return \Illuminate\Http\Response
     */

    public function get_tree(Request $request){

        $leagues = Treeentry::select('t1.entry_id','t1.parent_entry_id','t2.lang','t2.name')
         ->join('tree_entry_lang as t2', 't2.entry_id', '=', 't1.entry_id')
        ->orderBy('t1.parent_entry_id', 'ASC')
        ->get();
        if($leagues->count() > 0)
        {
                $data = self::membersTree($this->parentKey);
         }else{
                $data=["id"=>"0","name"=>"No Members present in list","text"=>"No Members is present in list","nodes"=>[]];
        }
        
        echo json_encode(array_values($data));
        //

    }

    private function membersTree($parentKey)
      {

        $results = Treeentry::select('t1.entry_id','t1.parent_entry_id','t2.lang','t2.name')
        ->join('tree_entry_lang as t2', 't2.entry_id', '=', 't1.entry_id')
        ->where('t1.parent_entry_id', $parentKey)
       ->orderBy('t1.parent_entry_id', 'ASC')
       ->get();
          //$sql = 'SELECT id, name from item WHERE parent_id="'.$parentKey.'"';
          /*$sql = "SELECT t1.entry_id,t1.parent_entry_id,t2.lang,t2.name FROM `tree_entry` t1 
          INNER JOIN tree_entry_lang t2 ON t2.entry_id = t1.entry_id 
          WHERE 1=1 AND t1.parent_entry_id='".$parentKey."'
          ORDER BY t1.parent_entry_id ASC ";
  
          $result = $mysqli->query($sql);*/
  
          //while($value = mysqli_fetch_assoc($result)){
        foreach($results as $key=>$value){
             $id = $value->entry_id;
             $row1[$id]['entry_id'] = $value->entry_id;
             $row1[$id]['name'] = $value->name;
             $row1[$id]['text'] = $value->name;
             $row1[$id]['nodes'] = self::membersTree($value->entry_id);
          }
  
          return @$row1;
      }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treeentry  $treeentry
     * @return \Illuminate\Http\Response
     */
    public function show(Treeentry $treeentry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treeentry  $treeentry
     * @return \Illuminate\Http\Response
     */
    public function edit(Treeentry $treeentry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treeentry  $treeentry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treeentry $treeentry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treeentry  $treeentry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treeentry $treeentry)
    {
        //
    }
}
