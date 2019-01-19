var svg = d3.select("svg"),
    width = +svg.attr("width"),
    height = +svg.attr("height");


var simulation = d3.forceSimulation()
    .force("link", d3.forceLink().id(function(d) { return d.id; }))
    .force("charge", d3.forceManyBody())
    .force("center", d3.forceCenter(width / 2, height / 2));

d3.json("assets/json_files/data.json", function(error, graph) {
  if (error) throw error;
  
  var link = svg.append("g")
      .attr("class", "links")
    .selectAll("line")
    .data(graph.links)
    .enter().append("line")
      .attr("stroke-width",5);
      

  var node = svg.append("g")
      .attr("class", "nodes")
      //.attr("id",d.id)
    .selectAll("circle")
    .data(graph.nodes)
    .enter().append("circle")
      .attr("r",function(d) { return GetRadius(d.group); })  // node size
      .attr("fill",function(d) { return GetColor(d.group); }) //node color
      .call(d3.drag()
          .on("start", dragstarted)
          .on("drag", dragged)
          .on("end", dragended)
          
                
                );
        
 var img=svg.append("defs")
                .append('pattern')
                                 .attr('id', 'logo1')

                                 .attr('width', 4)
                                 .attr('height', 4)
                                .append("image")
                                 .attr("xlink:href", "assets/image/logo1.jpg")
                                 .attr('width', 50)
                                 .attr('height', 50);
var img2=svg.append("defs")                         
                .append('pattern')
                                 .attr('id', 'logo2')
                                
                                 .attr('width', 4)
                                 .attr('height', 4)
                                .append("image")
                                 .attr("xlink:href", "assets/image/logo2.jpg")
                                 .attr('width', 50)
                                 .attr('height', 50);

           
 d3.selectAll("circle")
    .on("mouseover",mouseover)
    .on("mouseout",mouseout)
    .on ("click",mouseclick);
     
  
  simulation
      .nodes(graph.nodes)
      .on("tick", ticked);

  simulation.force("link")
      .links(graph.links);

  function ticked() {
    link
        .attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node
        .attr("cx", function(d) { return d.x; })
        .attr("cy", function(d) { return d.y; });
  }
});
function text(d){
    return d.id;
}
function dragstarted(d) {
  if (!d3.event.active) simulation.alphaTarget(0.3).restart();
  d.fx = d.x;
  d.fy = d.y;
}

function dragged(d) {
  d.fx = d3.event.x;
  d.fy = d3.event.y;
}

function dragended(d) {
  if (!d3.event.active) simulation.alphaTarget(0);
  d.fx = null;
  d.fy = null;
}


function mouseover(d){
 
 $('#control_panel').html('<p id="test"> en cours de conception</p> ');
 
//var nodeSize = d3.select(this).attr("r",20) ;     
//var nodeColor= d3.select(this).attr("fill","LightGreen");
var Title=d3.select(this).append("title").text(function(d){return d.id;});    
 

}

function mouseout(d){
    
// $("p").remove();   
// var nodeSize = d3.select(this).attr("r",10);       
// var nodeColor = d3.select(this).attr("fill", function(d) { return color(d.group); });   

}
var num;
var node;
var txt;
function mouseclick(d){
  var hidden= d3.selectAll("#butt").remove();  
  node=d3.select(this);
  txt=d.id;
  num=d.num;
  var a=0;        
   // var nodeSize = d3.select(this).attr("r",20) ; 
 var button1= svg.append("circle") 
		.attr("cx",d.x-30 ).attr("cy",d.y)
		.attr("r",25)
                .attr("fill","url(#logo2)") 
                .attr("id","butt")   
                .attr("stroke","black")
                .on("click",bouton1);
                
var button2= svg.append("circle") 
		.attr("cx",d.x+30 ).attr("cy",d.y)
		.attr("r",25)
		.attr("fill","url(#logo1)") 
                .attr("id","butt")
                .attr("stroke","black")
                .on("click",bouton2);
/*var button3= svg.append("ellipse") 
		.attr("cx",d.x ).attr("cy",d.y+20)
		.attr("rx", 12)
                .attr("ry",12)
		.attr("fill", "yellow")
                .on("click",bouton3);
var button4= svg.append("ellipse") 
		.attr("cx",d.x ).attr("cy",d.y-20)
		.attr("rx", 12)
                .attr("ry",12)
		.attr("fill", "green")
                .on("click",bouton4);
        
*/

}

function bouton1(d){
window.alert("message marqué");
var mar=modif(num,2);


var hidden= d3.selectAll("#butt").remove();



}
function bouton2(d){
window.alert("répondre");
var hidden= d3.selectAll("#butt").remove();
}


function GetColor(group){
    var color="";
    var state=group;
    switch(state){
        case 10://message source
            color="red";
            return color;
            break;
         
        case 1://message lu
            color="grey";
            return color;
            break;    
        case 2://message taggé
            color="black";
            return color;
            break;
        case 3://message repondu
            color="LightGrey";
            return color;
            break;
        case 4://notre message
            color="green";
            return color;
            break;
        default://message non lu
            color="grey";
            return color;
    }
}
function GetRadius(group){
    var radius;
    var state=group;
    switch(state){
        case 10://message source
            radius=20;
            return radius;
            break;
         
        case 1://message lu
            radius=10;
            return radius;
            break;    
        case 2://message taggé
            radius=10;
            return radius;
            break;
        case 3://message repondu
            radius=12;
            return radius;
            break;
        case 4://notre message
            radius=14;
            return radius;
            break;
        default://message non lu
            radius=15;
            return radius;
    }
}
function modif(id,state){
    var req=new XMLHttpRequest();
    var req2=new XMLHttpRequest();
   
    var num= 'id='+id;
    var group= 'group='+state;
    req.open('POST','http://localhost/bunchly/json_modif.php');
    req.send(id);
    
    req2.open('POST','http://localhost/bunchly/json_modif.php');
    req2.send(group);
   
    window.alert(num+group);
   
}
