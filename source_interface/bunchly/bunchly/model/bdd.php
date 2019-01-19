<?php

require_once 'assets\libraries\vendor\autoload.php';

use Neoxygen\NeoClient\ClientBuilder;

//$root=$client->getRoot();


      
    function GETrequete($query){
        $client= ClientBuilder::create()
        ->addConnection('Default','http', 'localhost', 7474,TRUE,'neo4j','bytethemall')
        ->setAutoFormatResponse(TRUE)
        ->build();
        $client->sendCypherQuery($query); 
       $results=$client->getRows();
       return $results;
    }
    function POSTrequete($query) {
        $client= ClientBuilder::create()
        ->addConnection('Default','http', 'localhost', 7474,TRUE,'neo4j','bytethemall')
        ->setAutoFormatResponse(TRUE)
        ->build();
        $client->sendCypherQuery($query);
    }
    if(isset($_GET['user']) && isset($_GET['msg']) ){
    
    $user=$_GET['user'];
    $msg=$_GET['msg'];
    $request='match(n:user) where n.pseudo="'.$user.'" match(m:Message) where m.text="'.$msg.'" create(n)-[:a_marque]->(m)"';
    POSTrequete($request);
}
    
?>
    

