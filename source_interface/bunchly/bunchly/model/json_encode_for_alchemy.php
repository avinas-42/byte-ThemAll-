<?php

function sigmajson($data){
    $count=count($data['n']);
    $id=0;
    $x=0;
    $y=0;
    $arr=array("nodes"=>array(),"edges"=>array());
    $node=array();
    

   for($i=0;$i<$count;$i++){
       $id++;
       $y=$y+2;
      
       $text=$data['n'][$i]['text'];
       $target=$data['n'][$i]['source'];    
       $z=0;
   
      $ii=0;
      if($ii!=$i){
          $ii=$i-1;
      }else{$ii=0;}
      

       $try=$data['n'][$ii]['id'];   
       
           
      
        if($id!=1){
            if($target!=$try){
             $z=$z+2;
                
                $edges=array("id"=>"$id","source"=>"$id","target"=>"$target");
                $node=array("id"=>"$id","label"=>$text,"size"=>5,"x"=>$z,"y"=>$y);
                
            }else{
                $edges=array("id"=>"$id","source"=>"$id","target"=>"$target");
                $node=array("id"=>"$id","label"=>$text,"size"=>5,"x"=>$x,"y"=>$y);
            }
        }else{
            $edges=array("id"=>"$id","source"=>"$id","target"=>"$id","size"=>3);
            $node=array("id"=>"$id","label"=>$text,"size"=>5,"x"=>0,"y"=>0);
        }
        
       
       $arr["nodes"][]=$node;
       $arr["edges"][]=$edges;
       
       $json= json_encode($arr);
       
       
       
      
               
   }
        $adrjson='assets/json_files/data.json';
       $fichier=fopen($adrjson,'w+');
       fwrite($fichier,$json);
       fclose($fichier);     
     
}

