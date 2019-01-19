<?php

$id=$_POST["num"];
$group=$_POST["group"];
/*$json2=file_get_contents('assets/json_files/data.json');
$parsed_json2=json_decode($json2);
print_r($parsed_json2);
$label=$parsed_json2["node"][$id]["id"];
$parsed_json2["node"][$id]=array("id"=>"$label","group"=>$group,"num"=>$id);

 
       $fichier=fopen('assets/json_files/data.json','w');
       fwrite($fichier,$parsed_json2);
       fclose($fichier);   
*/
var_dump($group);
var_dump($id);