 var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var labelIndex = 0;
    var ena = 1;
    var path;
    var poly;
    var map;
    var lpozo;
    var lpoly;
    var markers;
    var ban1=0;
    var Poligono;
    var lpoly3;
    var Poligonos=[];
    var listenerbp=[];
    var infos=[];
    var ids=[];
    var Minfrar=[];
    var Mpozos=[];
    var Mvalvulas=[];
    var Mbombeo=[];
    var Marcador;
    var lddis=[];
    function enableMap(x){
      if(x.style.color=="#039be5"){
        x.style.color = "green";
      }
      else{
        x.style.color = "#039be5";
      }
      return false;
    }

    function initialize(){
      var myLatLng = new google.maps.LatLng(17.98277425306777,-92.93807985261083); //Se especifica la latitud y la longitud
      var mapOptions = {
      zoom: 13,
      center: myLatLng,
      mapTypeId: google.maps.MapTypeId.SATELLITE 
      };
      
      map = new google.maps.Map(document.getElementById("map"),mapOptions);

      //Evento que permite localizar puntos en el mapa y añade marcadores
      lpozo=google.maps.event.addListener(map, 'click', function (event){
        addMarker(event.latLng, map);
      });
      //addMarker(myLatLng, map);
      google.maps.event.removeListener(lpozo);
      document.getElementById("slide-out");
      cargarDistritos();
      }

    //modificando la imagen del marcador
    var image="../img/map/pozo1.png";

    //añade marcadores al mapa
    function addMarker(location, map){
      Marcador = new google.maps.Marker({
        position: location,
        label: labels[labelIndex++ % labels.lenght],
        map: map,
        icon: image,
      });
      $('#aceptarM').click();
    } 
    google.maps.event.addDomListener(window, 'load', initialize);
/*
 * Esta función inicializa el polígono y añade el listener para el evento click
 * @param  {[map]} map [Mapa principal de GISSAT]
 * @return 
 *  */
function iniPoli(map) {
  ban1=0;
  markers=[];
  Poligonos=[];
 poly = new google.maps.Polyline({
    strokeColor: '#000000',
    strokeOpacity: 1.0,
    strokeWeight: 3
  });
  poly.setMap(map);

  // Add a listener for the click event
  lpoly=google.maps.event.addListener(map,'click', function(event){
    AddPunto(event.latLng,map);
  });
  lpoly2=google.maps.event.addListener(map,'rightclick', function(event){
    BorrarUltimo(path,markers);
  });
  google.maps.event.addDomListener(document, 'keyup', function (event) {

    var code = (event.keyCode ? event.keyCode : event.which);
    if (code == 13) {
        window.location.href ='#aceptarpoly';    
    }
   });
   google.maps.event.addDomListener(document, 'keyup', function (event) {

    var code = (event.keyCode ? event.keyCode : event.which);
    if (code == 27) {
         window.location.href ='#cancelp'; 
    }});
}

function QuitarM(){
 Marcador.setMap(null);
 Marcador="";
}

function CancelarM(){
  google.maps.event.removeListener(lM); 
 Marcador.setMap(null);
 Marcador="";
}

/**
 * Añade un punto al polígono o arreglo de puntos
 * @param  {[type]} event [Evento click]
 * @return 
 */
function AddPunto(pos,map) {
  path = poly.getPath();

  // Because path is an MVCArray, we can simply append a new coordinate
  // and it will automatically appear.
  path.push(pos);


  // Add a new marker at the new plotted point on the polyline.
  var marker= new google.maps.Marker({
    position: pos,
    title: '#' + path.getLength(),
    map: map
  });
  markers.push(marker);
  CrearPoli(path);
}
/**
 * borra el ultimo elemento del arreglo de latitudes y longitudes
 * @param {[type]} path [Arreglo del cual se va a eliminar]
 */
function BorrarUltimo(path,markers)
{
  //alert(path.getLength() +" tamaño de marcador: " +markers.length );
  if(path.getLength()>=1 && markers.length>=1)
  {
    //markers[markers.lenght-1].setMap(null);
    path.pop();
    markers.pop().setMap(null);
    //alert(path.getLength() +" tamaño de marcador: " +markers.length );
  }
}
/**
 * Recibe un arreglo de latitudes y longitudes para crear un poligono
 * @param {[type]} path [Arreglo de latitudes y longitudes]
 */
function CrearPoli(path)
{
  if(ban1==0){
    Poligono = new google.maps.Polygon({
    tipo:"Sector",
    id:1,
    paths: path,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 3,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });
  Poligono.setMap(map);
  ban1=1;
   lpoly3=Poligono.addListener('click',function(event){
    AddPunto(event.latLng,map);
  });  
  }
  
}
function mostrar(){
document.getElementById('opcspoli').style.display = 'block';
document.getElementById('opcsp').style.display = 'none';
iniPoli(map);
}

function ocultarpanel1(){

   google.maps.event.removeListener(lpoly);
   google.maps.event.removeListener(lpoly2);
   google.maps.event.clearListeners(Poligono,'click');
   google.maps.event.clearListeners(map,'keyup');
  var coord=" ";
  for(var i=0; i<markers.length;i++){
    if(i==0){
    coord=markers[i].getPosition()+'';
  }else{
    coord=coord+'\n'+markers[i].getPosition()+'';
    }
    coord=coord.replace("(","");
    coord=coord.replace(")",""); 
  }
  var opcion = validate('grupo');
  switch(opcion){
            case "Sector-r":
              document.getElementById('acoordenadas3').value=coord;
              break;
            case "Subsector-r":
              document.getElementById('acoordenadas2').value=coord;
              break; 
            case "Distrito-r":
              document.getElementById('acoordenadas1').value=coord;
              break; 
       }
  for(i=0;i<markers.length;i++)
  {
    markers[i].setMap(null);
  }
  document.getElementById('opcspoli').style.display = 'none';
  document.getElementById('opcsp').style.display = 'block'; 
  Poligonos.push(Poligono);
  abrirfpoli(); 
}

function cancelpoly(){
  
  google.maps.event.removeListener(lpoly);
  google.maps.event.removeListener(lpoly2);
  google.maps.event.clearListeners(Poligono,'click');
  google.maps.event.clearListeners(map,'keyup');
  for(var i=0;i<markers.length;i++)
  {
    markers[i].setMap(null);
    path.pop(); 
  }
  markers=[];
  path=[];
  Poligono.setMap(null);
  document.getElementById('opcsp').style.display = 'block';
  document.getElementById('opcspoli').style.display = 'none'; 
}

function updates(jscolor) {
    // 'jscolor' instance can be used as a string
    Poligonos[0].setOptions({
    strokeColor: '#'+ jscolor})
}
function updatef(jscolor) {
    // 'jscolor' instance can be used as a string
    Poligonos[0].setOptions({
    fillColor: '#'+ jscolor})
}
/**
 * Funcion que valida la opcion seleccionada
 * @return retorna el element seleccionado. Retorna falso si no hay elemento seleccionado
 */
function validate(value){
    radio = document.getElementsByName(value);
    var validacion = false;
    for (var i = 0 ; i < radio.length ; i++) {
        if(radio[i].checked){
            return radio[i].id;;
            break;
        }
    }
    return false;
}
/**
 * Evalua el radio button seleccionado y abre el formulario correspondiente
 * @return {[type]} [description]
 */
function abrirfpoli()
{
  var opcion = validate('grupo');
  switch(opcion){
            case "Sector-r":
              $('#abre-sector').click();
              break;
            case "Distrito-r":
              $('#abre-distrito').click();
              break;
            case "Subsector-r":
              $('#abre-subsector').click();
              break;
            case "Tanque-r":
              $('#abre-tanque').click();
              break;
            case "Valvula-r":
              $('#abre-valvula').click();
              break;
             case "Pozo-r":
              $('#abre-pozo').click();
              break; 
             case "Bombeo-r":
              $('#abre-bombeo').click();
              break;          
       }
}

function mostrarM(){
  var opcion = validate('grupo');
  switch(opcion){
            case "Sector-r":
              mostrar();
              break;
            case "Distrito-r":
               mostrar();
              break;
            case "Subsector-r":
               mostrar();
              break;
            case "Tanque-r":
              Addmarcador('Tanque');
              break;
            case "Valvula-r":
              Addmarcador('Valvula');
              break;
             case "Pozo-r":
              Addmarcador('Pozo');
              break;
             case "Bombeo-r":
              Addmarcador('Bombeo');
              break;            
       }
}

function Addmarcador(tipo){
  switch(tipo){
    case "Tanque":
    image="../img/map/tanque.png";
    break;

    case "Pozo":
    image="../img/map/pozo1.png";
    break;

    case "Valvula":
    image="../img/map/valvula.png";
    break;

     case "Bombeo":
    image="../img/map/bomba.png";
    break;
  }
  lM=google.maps.event.addListener(map, 'click', function (event){
        addMarker(event.latLng, map);
      });
 $('#agregarM').click(); 
}

function aceptarM(){
  google.maps.event.removeListener(lM);
  var coord="";
  coord=Marcador.getPosition()+'';
  coord=coord.replace("(","");
  coord=coord.replace(")","");
  coord=coord.replace(",","");
  var aux=coord.split(" ");
  var opcion = validate('grupo'); 
  switch(opcion){
            case "Pozo-r":
              document.getElementById('latitud_fe1').value=aux[0];
              document.getElementById('longitud_fe1').value=aux[1];
              abrirfpoli();
              break;
            case "Tanque-r":
              document.getElementById('latitud_ir').value=aux[0];
              document.getElementById('longitud_ir').value=aux[1];
              abrirfpoli();
              break; 
            case "Valvula-r":
              document.getElementById('latitud_val').value=aux[0];
              document.getElementById('longitud_val').value=aux[1];
              abrirfpoli();
              break;
            case "Bombeo-r":
              document.getElementById('latitud_ib').value=aux[0];
              document.getElementById('longitud_ib').value=aux[1];
              abrirfpoli();
              break;      
       }
}
/**
 * Carga todos los sectores en el mapa usando archivos de texto
 * @return {[type]} [description]
 */
function cargarSectores(){
  var id;
  var arr1;//arreglo auxiliar que guarda cada linea de coordenadas
  var arr2=[];//arreglo auxiliar que guarda cada coordenada por separado
  var arr3=[];//arreglo auxiliar que guarda el arreglo de coordenadas con formato para googlemaps
  var aux;//
  var c1;//
  var l1;
  var f1;
  var cami;
  var nom;
  for(var i = 1 ; i <= document.getElementById('sec').value ; i++){
  id='sec'+document.getElementById('sectores'+i).value;
  arr2=[];
  arr3=[];
  nom=document.getElementById(''+id).name;
  cami=document.getElementById(''+id).value;
  arr1=cami.split('\n');
  for(var z=0;z < arr1.length;z=z+2){
    aux=arr1[z].split(',');
    arr2.push(aux[0]);
    arr2.push(aux[1]);
  }
  nom=nom.replace("_"," ");
  for(var j=0; j<arr2.length-1;j=j+2){
    aux=new google.maps.LatLng(arr2[j],arr2[j+1]);
    arr3.push(aux);
  }
  l1='#'+document.getElementById('l'+id).value;
  f1='#'+document.getElementById('f'+id).value;
  nom=nom.replace(/_/g," ");
  Poligono = new google.maps.Polygon({
    tipo:"Sector",
    id:document.getElementById('sectores'+i).value,
    nombre:nom,
    paths: arr3,
    strokeColor: l1,
    strokeOpacity: 0.8,
    strokeWeight: 3,
    fillColor: f1,
    fillOpacity: 0.35,
    visible:false
  });
   Poligono.info= new google.maps.InfoWindow({
    content: ""+nom+""
  });
  google.maps.event.addListener(Poligono, 'click', function(event) {
    if (event) {
      point = event.latLng;
    }
    this.info.setPosition(point);
    this.info.open(map);
   }); 
  Poligono.setMap(map);
  Poligonos.push(Poligono);
  Poligono="";
  }
}
/**
 * Funcion que carga todos los subsectores en el mapa
 * @return {[type]} [description]
 */
function cargarSubsectores(){
  var id;
  var arr1;//arreglo auxiliar que guarda cada linea de coordenadas
  var arr2=[];//arreglo auxiliar que guarda cada coordenada por separado
  var arr3=[];//arreglo auxiliar que guarda el arreglo de coordenadas con formato para googlemaps
  var aux;//
  var c1;//
  var l1;
  var f1;
  var cami;
  var nom;
  for(var i = 1 ; i <= document.getElementById('sub').value ; i++){
  id='sub'+document.getElementById('subsectores'+i).value;
  arr2=[];
  arr3=[];
  nom=document.getElementById(''+id).name; 
  cami=document.getElementById(''+id).value;
  arr1=cami.split('\n');
  for(var z=0;z < arr1.length;z=z+2){
    aux=arr1[z].split(',');
    arr2.push(aux[0]);
    arr2.push(aux[1]);
  }
  nom=nom.replace(/_/g," ");
  for(var j=0; j<arr2.length-1;j=j+2){
    aux=new google.maps.LatLng(arr2[j],arr2[j+1]);
    arr3.push(aux);
  }
  l1='#'+document.getElementById('l'+id).value;
  f1='#'+document.getElementById('f'+id).value;
  Poligono = new google.maps.Polygon({
    tipo:"Subsector",
    id:document.getElementById('subsectores'+i).value,
    nombre:nom,
    paths: arr3,
    strokeColor: l1,
    strokeOpacity: 0.8,
    strokeWeight: 3,
    fillColor: f1,
    fillOpacity: 0.35,
    visible:false
  });
  Poligono.setMap(map);
   Poligono.info= new google.maps.InfoWindow({
    content:""+nom+""
  });
  google.maps.event.addListener(Poligono, 'click', function(event) {
    if (event) {
      point = event.latLng;
    }
    this.info.setPosition(point);
    this.info.open(map);
   }); 
  Poligonos.push(Poligono);
  Poligono="";
  }
}
/**
 * Funcion que carga todos los distritos en el mapa
 * @return {[type]} [description]
 */
function cargarDistritos(){
  var id;
  var arr1;//arreglo auxiliar que guarda cada linea de coordenadas
  var arr2=[];//arreglo auxiliar que guarda cada coordenada por separado
  var arr3=[];//arreglo auxiliar que guarda el arreglo de coordenadas con formato para googlemaps
  var aux;//
  var c1;//
  var l1;
  var f1;
  var cami;
  var nombre;
  var bounds= new google.maps.LatLngBounds();//Crea una variable con los bounds necesarios
  for(var i = 1 ; i <= document.getElementById('dis').value ; i++){
  id='dis'+document.getElementById('distritos'+i).value;
  arr2=[];
  arr3=[]; 
  cami=document.getElementById(''+id).value;
  arr1=cami.split('\n');
  nom=document.getElementById(''+id).name;
  for(var z=0;z < arr1.length;z=z+2){
    aux=arr1[z].split(',');
    arr2.push(aux[0]);
    arr2.push(aux[1]);
  }
  nom=nom.replace(/_/g," ");
  for(var j=0; j<arr2.length-1;j=j+2){
    aux=new google.maps.LatLng(arr2[j],arr2[j+1]);
    bounds.extend(aux);
    arr3.push(aux);
  }
  l1='#'+document.getElementById('l'+id).value;
  f1='#'+document.getElementById('f'+id).value;
  Poligono = new google.maps.Polygon({
    tipo:"Distrito",
    id:document.getElementById('distritos'+i).value,
    nombre:nom,
    paths: arr3,
    strokeColor: l1,
    strokeOpacity: 0.8,
    strokeWeight: 3,
    fillColor: f1,
    fillOpacity: 0.35,
    visible:true
  });
  Poligono.setMap(map);
   Poligono.info= new google.maps.InfoWindow({
    content: ""+nom+""
  });
  map.fitBounds(bounds);
  map.panToBounds(bounds);
  Poligonos.push(Poligono);
  Poligono="";
  }
}
/**
 * oculta el poligono del mapa dependiendo de su id y su tipo
 * @param  {[type]} id   [description]
 * @param  {[type]} tipo [description]
 * @return {[type]}      [description]
 */
function ocultarpoli(id,tipo){
  for(var i=0;i<Poligonos.length;i++){
    if(tipo.localeCompare(Poligonos[i].tipo)==0 && id==Poligonos[i].id){
      //Poligonos[i].setMap(null);
      Poligonos[i].setOptions({
    visible:false});
    }
  }
}
/**
 * muestra el poligono en el mapa depedendiendo de su id y su tipo
 * @param  {[type]} id   [description]
 * @param  {[type]} tipo [description]
 * @return {[type]}      [description]
 */
function mostrarpoli(id,tipo){
  for(var i=0;i<Poligonos.length;i++){
    var a=tipo.localeCompare(Poligonos[i].tipo);
    var b=id.localeCompare(Poligonos[i].id);
    if(a==0 && b==0){
      //Poligonos[i].setMap(map);
      Poligonos[i].setOptions({
    visible:true});
    }
  }
}
/**
 * Carga todos los poligonos en el mapa
 * @return {[type]} [description]
 */
function mostrartodopolis(){
cargarSectores();
cargarSubsectores();
cargarDistritos();
}
$( document ).ready(function() {
   
});

 

function CenterControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Clic para activar herramienta "Detalle de distritos"';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '10px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = '<i class="small material-icons" style="margin-right:0px;">visibility</i>';
        controlUI.appendChild(controlText);

        controlUI.addEventListener('click', function() {
          detalleDistritos();
        });

      }

    function opacidad(){
    document.getElementById('sidenav-overlay').style="opacity:0;";
    } 

function detalleDistritos(){
  var aux1;
  for(var i=0;i<Poligonos.length;i++){
      if(Poligonos[i].tipo=="Distrito"){
        aux1=Poligonos[i].addListener('click',function(event){
        var id=this.id;
        var tipo=this.tipo;
        var nombre=this.nombre;
        nombre=nombre.replace("_"," ");
        /*$('#').text('Tipo: '+tipo);
        $('#').text('ID: '+id);*/
        $('#Mdis').text('Circuito: '+nombre);
        $('#muestra-distrito').click();
        irdetalle(id);
      }); 
      lddis.push(aux1); 
      }
    }
}

function irdetalle(id){
  document.getElementById('detalledis').value=id;
  $('#buttondetalledis').click();  
}