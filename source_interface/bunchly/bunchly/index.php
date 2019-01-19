<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Bunchly  </title>
        <link href="assets/css/css.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            
            <h1>Bunchly_project </h1>
            <div id="menu"> <!--debut menu-->
                <nav>
                    <ul>
                        <a href="#"><li>Déconnexion</li></a>
                        <a href="#"><li>Favoris</li></a> 
                        <a href="#"><li>Mon profil</li></a>
                         
                    </ul>
                </nav>
            </div>  <!--fin menu-->
            
        </header>
        
        <div class="corps">
            
            <article id="graphe"><!--zone allouée au graphe-->
             <style>

                .links line {
                 stroke: #999;
                 stroke-opacity: 0.6;
                }       

                .nodes circle {
                     stroke: #fff;
                     stroke-width: 1.5px;
                    }

             </style>   
              <svg width="1200" height="700"></svg>
            <script src="https://d3js.org/d3.v4.min.js"></script>  
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <script src="assets/script/transfert.js" type="text/javascript"></script>
             <?php
                require 'model/bdd.php';   // fichier gérant la connexion a la base néo4j ainsi que la création de requetes
                require 'model/json_encode_for_d3.php';//fichier créant desd fichiers json
               
               /* $query="match (n:message) return n";    //permet d'actualiser le fichier data.json 		   
               $results=GETrequete($query);              //ici le fichier est déja rempli , ce qui devrais aboutir a la création du graphe , sans causer d'erreur du au fait que la base ne soit pas accessiblle 
               sigmajson($results);
            */
       
       
       
       
      
               
                ?>
            
            <script type="text/javascript" src="assets/script/graphe.js"></script>   
                                
            </article>
           
            <aside id="control_panel"> <!--partie "paneau de controle" (zone test)-->
                <p><h3>Panneau de controle</h3></p>
            </aside>
                      
            
        </div>
      
    
    </body>
     
            
    
</html>
