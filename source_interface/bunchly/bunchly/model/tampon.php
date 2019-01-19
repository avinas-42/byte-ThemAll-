<?php
require 'bdd.php';
require 'tag.php';
$user = (isset($_GET["user"])) ? $_GET["user"] : NULL;
               $msg = (isset($_GET["msg"])) ? $_GET["msg"] : NULL;
 
               if ($user && $msg) {
                 
                                 
                  $requ=tagg($user,$msg);
                 POSTrequete($requ);
                    }
                        
                              