<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function sigmajson($data){
    
    
    $count=count($data['n']);
    $id=0;
    
    $arr=array("nodes"=>array(),"links"=>array());
    $node=array();
    $links=array();
    $idn=$data['n'][$id]['id'];
   for($i=0;$i<$count;$i++){
      
       $label=$data['n'][$id]['text'];
      // var_dump($label);
       $target2=$data['n'][$id]['source'];
       $target2=$target2-1;
       
       $target=$data['n'][$target2]['text'];
      // var_dump($target);
           
      
        if($id!=0){
             $links=array("source"=>"$label","target"=>"$target");
                $node=array("id"=>"$label","group"=>0,"num"=>$id);
        }else{   //si msg source
                $links=array("source"=>"$label","target"=>"$label");
                $node=array("id"=>"$label","group"=>10,"num"=>$id);
        }
        
       
       $arr["nodes"][]=$node;
       $arr["links"][]=$links;
     //  var_dump($arr); 
      $json= json_encode($arr);
       
       
       
      
        $id ++;       
   }
        $adrjson='assets/json_files/data.json';
       $fichier=fopen($adrjson,'w+');
       fwrite($fichier,$json);
       fclose($fichier);     
     
}



