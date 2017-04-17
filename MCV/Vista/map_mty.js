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
      $('#cargarpolismapa').click();
      var centerControlDiv = document.createElement('div');
      var centerControl = new CenterControl(centerControlDiv, map);

        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(centerControlDiv);
        $( document ).ready(function() {
          $('#zonas').click();
        });
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
    visible:false
  });
  Poligono.setMap(map);
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

/**
 * agrega los listener necesarios a los poligonos en el mapa para que se borre el elegido
 * @return {[type]} [description]
 */
function borrarsel(){
  document.getElementById('opcsp').style.display = 'none';
  listenerbp=[];
  var auxbp;
  for(var i=0;i<Poligonos.length;i++){
    auxbp=Poligonos[i].addListener('click',function(event){
    var id=this.id;
    var tipo=this.tipo;
    var nombre=this.nombre;
    nombre=nombre.replace("_"," ");
    $('#tipoPoli').text('Tipo: '+tipo);
    $('#idPoli').text('ID: '+id);
    $('#nombrePoli').text('Nombre: '+nombre);
    $('#irelimpoli').click();
  }); 
   listenerbp.push(auxbp); 
  }
  for(var i=0;i<Minfrar.length;i++){
    auxbp=Minfrar[i].addListener('click',function(event){
    var id=this.id;
    var nombre=this.nombre;
    $('#tipoPoli').text('Tipo: Tanque');
    $('#idPoli').text('ID: '+id);
    $('#nombrePoli').text('Nombre: '+nombre);
    $('#irelimpoli').click();
  });
  listenerbp.push(auxbp);   
  }
  for(var i=0;i<Mpozos.length;i++){
    auxbp=Mpozos[i].addListener('click',function(event){
    var id=this.id;
    var nombre=this.nombre;
    $('#tipoPoli').text('Tipo: Pozo');
    $('#idPoli').text('ID: '+id);
    $('#nombrePoli').text('Nombre: '+nombre);
    $('#irelimpoli').click();
  }); 
  listenerbp.push(auxbp);  
  }
  for(var i=0;i<Mvalvulas.length;i++){
    auxbp=Mvalvulas[i].addListener('click',function(event){
    var id=this.id;
    $('#tipoPoli').text('Tipo: Valvula');
    $('#idPoli').text('ID: '+id);
    $('#nombrePoli').text('');
    $('#irelimpoli').click();
  });
  listenerbp.push(auxbp);   
  }

  for(var i=0;i<Mbombeo.length;i++){
    auxbp=Mbombeo[i].addListener('click',function(event){
    var id=this.id;
    var nombre=this.nombre;
    $('#tipoPoli').text('Tipo: Bombeo');
    $('#idPoli').text('ID: '+id);
    $('#nombrePoli').text('Nombre: '+nombre);
    $('#irelimpoli').click();
  });
  listenerbp.push(auxbp);   
  }

}

/**
 * Quita los listeners de borrar a los objectos en el mapa
 * @return {[type]} [description]
 */
function cancelborrarsel(){
  document.getElementById('opcsp').style.display = 'block';
  for(var i=0;i<listenerbp.length;i++){
    google.maps.event.removeListener(listenerbp[i]);
  }
}


function editarsel(){
  document.getElementById('opcsp').style.display = 'none';
  listenerep=[];
  var arr1=[];
  var arr2=[];
  var aux;
  var auxl;
  for(var i=0;i<Poligonos.length;i++){
    auxl=Poligonos[i].addListener('click',function(event){
    var id=this.id;
    var tipo=this.tipo;
    var nombre=this.nombre;
    if(tipo=="Distrito"){
      document.getElementById('titdis').text="Editar Distrito";
      var coord=document.getElementById('dis'+id).value;
      arr1=coord.split('\n');
      for(var z=0;z < arr1.length;z=z+2){
      aux=arr1[z];
      aux=aux+'\n';
      arr2.push(aux);
      }
      aux='';
      for(var i=0;i<arr2.length;i++){
        aux=aux+arr2[i];
      }
      $('#titdis').text("Editar Distrito");
      document.getElementById('acoordenadas1').value=aux;
      document.getElementById('nombre_dis').value=nombre;
      document.getElementById('fdis').action='http://localhost/GISSAT/edit_controller/editar_distrito';
      $('#editdis').attr("onclick","editpoli('Distrito'); canceleditarsel();");
      $('#editdis').text("Editar");
      $('#Canceldis').attr("onclick","$('.button-collapse').sideNav('hide'); canceleditarsel()");
      $('#id_dis').attr('value',id);
      $('#abre-distrito').click();
    }
    if(tipo=="Subsector"){
      $('#titsub').text("Editar Subsector");
      document.getElementById('acoordenadas2').value=aux;
      document.getElementById('nombre_sub').value=nombre;
      document.getElementById('fsub').action='http://localhost/GISSAT/edit_controller/editar_subsector';
      $('#editsub').attr("onclick","editpoli('Subsector'); canceleditarsel();");
      $('#editsub').text("Editar");
      $('#Cancelsub').attr("onclick","$('.button-collapse').sideNav('hide'); canceleditarsel()");
      $('#id_sub').attr('value',id); 
     $('#abre-subsector').click(); 
    }
    if(tipo=="Sector"){
     $('#titsec').text("Editar Sector");
      document.getElementById('acoordenadas3').value=aux;
      document.getElementById('nombre_sec').value=nombre;
      document.getElementById('fsa').action='http://localhost/GISSAT/edit_controller/editar_sector';
      $('#editsec').attr("onclick","editpoli('Sector'); canceleditarsel();");
      $('#editsec').text("Editar");
      $('#Cancelsec').attr("onclick","$('.button-collapse').sideNav('hide'); canceleditarsel()");
      $('#id_sec').attr('value',id);  
     $('#abre-sector').click(); 
    }
  }); 
  listenerep.push(auxl); 
  }
  for(i=0;i<Minfrar.length;i++){
     auxl=Minfrar[i].addListener('click',function(event){
      lat=this.getPosition().lat();
      lng=this.getPosition().lng();
      id=this.id;
      nombre=this.nombre;
      $('#titir').text("Editar Infraestructura de regularización");
      document.getElementById('latitud_ir').value=lat;
      document.getElementById('longitud_ir').value=lng;
      document.getElementById('nombre_ir').value=nombre;
      document.getElementById('fir').action='http://localhost/GISSAT/edit_controller/editar_tanque';
      $('#editir').attr("onclick","canceleditarsel();");
      $('#editir').text("Editar");
      $('#cancelir').attr("onclick","$('.button-collapse').sideNav('hide'); canceleditarsel()");
      $('#id_edit_ir').attr('value',id); 
     $('#abre-tanque').click(); 
     });
     listenerep.push(auxl);  
  }

  for(i=0;i<Mvalvulas.length;i++){
     auxl=Mvalvulas[i].addListener('click',function(event){
      lat=this.getPosition().lat();
      lng=this.getPosition().lng();
      id=this.id;
      nombre=this.nombre;
      $('#titval').text("Editar Valvula");
      document.getElementById('latitud_val').value=lat;
      document.getElementById('longitud_val').value=lng;
      document.getElementById('tipo_val').value=nombre;
      document.getElementById('fvalvula').action='http://localhost/GISSAT/edit_controller/editar_valvula';
      $('#edit_val').attr("onclick","enviarval(); canceleditarsel();");
      $('#edit_val').text("Editar");
      $('#cancel_val').attr("onclick","$('.button-collapse').sideNav('hide'); canceleditarsel();");
      $('#id_edit_val').attr('value',id);
     $('#abre-valvula').click(); 
     });
     listenerep.push(auxl); 
  }

  for(i=0;i<Mpozos.length;i++){
     auxl=Mpozos[i].addListener('click',function(event){
      lat=this.getPosition().lat();
      lng=this.getPosition().lng();
      id=this.id;
      id2=this.id2;
      nombre=this.nombre;
      $('#titpozo').text("Editar Pozo");
      document.getElementById('latitud_fe1').value=lat;
      document.getElementById('longitud_fe1').value=lng;
      document.getElementById('nombre_fe1').value=nombre;
      document.getElementById('fpozo').action='http://localhost/GISSAT/edit_controller/editar_pozo';
      $('#edit_pozo').attr("onclick","canceleditarsel();");
      $('#edit_pozo').text("Editar");
      $('#cancel_pozo').attr("onclick","$('.button-collapse').sideNav('hide'); canceleditarsel();");
      $('#id_edit_pozo').attr('value',id);
      $('#id_edit_fe').attr('value',id2);
     $('#abre-pozo').click(); 
     });
     listenerep.push(auxl); 
  }

  for(i=0;i<Mbombeo.length;i++){
     auxl=Mbombeo[i].addListener('click',function(event){
      lat=this.getPosition().lat();
      lng=this.getPosition().lng();
      id=this.id;
      nombre=this.nombre;
      $('#titbombeo').text("Editar Bombeo");
      document.getElementById('latitud_ib').value=lat;
      document.getElementById('longitud_ib').value=lng;
      document.getElementById('nombre_ib').value=nombre;
      document.getElementById('fbombeo').action='http://localhost/GISSAT/edit_controller/editar_bombeo';
      $('#edit_bombeo').attr("onclick","canceleditarsel();");
      $('#edit_bombeo').text("Editar");
      $('#cancel_bombeo').attr("onclick","$('.button-collapse').sideNav('hide'); canceleditarsel();");
      $('#id_edit_ib').attr('value',id);
     $('#abre-bombeo').click(); 
     });
     listenerep.push(auxl); 
  }

}

function canceleditarsel(){
  document.getElementById('opcsp').style.display = 'block';
  for(var i=0;i<listenerep.length;i++){
    google.maps.event.removeListener(listenerep[i]);
  }
      $('#titdis').text("Formulario de Distritos");
      document.getElementById('acoordenadas1').value='';
      document.getElementById('nombre_dis').value='';
      document.getElementById('fdis').action='http://localhost/GISSAT/record_Controller/registrar_dis';
      $('#editdis').attr("onclick","enviardis('Distrito')");
      $('#editdis').text("Registrar");
      $('#Canceldis').attr("onclick","$('.button-collapse').sideNav('hide'); cancelpoly();");

      $('#titsub').text("Formulario de Subsectores");
      document.getElementById('acoordenadas2').value='';
      document.getElementById('nombre_sub').value='';
      document.getElementById('fsub').action='http://localhost/GISSAT/record_controller/registrar_sub';
      $('#editsub').attr("onclick","asigncolor(2)");
      $('#editsub').text("Registrar");
      $('#Cancelsub').attr("onclick","$('.button-collapse').sideNav('hide'); cancelpoly();");

      $('#titsec').text("Formulario de Sectores");
      document.getElementById('acoordenadas3').value='';
      document.getElementById('nombre_sec').value='';
      document.getElementById('fsa').action='http://localhost/GISSAT/record_controller/registrar_sa';
      $('#editsec').attr("onclick","asigncolor(3)");
      $('#editsec').text("Registrar");
      $('#Cancelsec').attr("onclick","$('.button-collapse').sideNav('hide'); cancelpoly();");

       $('#titir').text("Formulario de Infraestructura de regularización");
      document.getElementById('latitud_ir').value='';
      document.getElementById('longitud_ir').value='';
      document.getElementById('nombre_ir').value='';
      document.getElementById('fir').action='http://localhost/GISSAT/record_controller/registrar_tanque';
      $('#editir').attr("onclick","");
      $('#editir').text("Registrar");
      $('#cancelir').attr("onclick","$('.button-collapse').sideNav('hide');");
      $('#id_edit_ir').attr('value','');

      $('#titval').text("Formulario de Valvula");
      document.getElementById('latitud_val').value='';
      document.getElementById('longitud_val').value='';
      document.getElementById('tipo_val').value='';
      document.getElementById('fvalvula').action='http://localhost/GISSAT/record_controller/registrar_valvula';
      $('#edit_val').attr("onclick","enviarval();");
      $('#edit_val').text("Registrar");
      $('#cancel_val').attr("onclick","$('.button-collapse').sideNav('hide');");
      $('#id_edit_val').attr('value','');

      $('#titpozo').text("Formulario de Pozo");
      document.getElementById('latitud_fe1').value='';
      document.getElementById('longitud_fe1').value='';
      document.getElementById('nombre_fe1').value='';
      document.getElementById('fpozo').action='http://localhost/GISSAT/record_controller/registrar_pozo';
      $('#edit_pozo').attr("onclick","");
      $('#edit_pozo').text("Registrar");
      $('#cancel_pozo').attr("onclick","$('.button-collapse').sideNav('hide');");
      $('#id_edit_pozo').attr('value','');
      $('#id_edit_fe').attr('value','');

      $('#titbombeo').text("Formulario de Bombeo");
      document.getElementById('latitud_ib').value='';
      document.getElementById('longitud_ib').value='';
      document.getElementById('nombre_ib').value='';
      document.getElementById('fpozo').action='http://localhost/GISSAT/record_controller/registrar_bombeo';
      $('#edit_bombeo').attr("onclick","");
      $('#edit_bombeo').text("Registrar");
      $('#cancel_bombeo').attr("onclick","$('.button-collapse').sideNav('hide');");
      $('#id_edit_ib').attr('value','');
}


/**
 * Carga los marcadores de tanques al mapa
 * @return {[type]} [description]
 */
function cargarinfrar(){
  var image="../img/map/tanque.png";
  for(var i=1;i<=document.getElementById('infrarnum').value;i++){
    var id=document.getElementById('infrar'+i).value;
    id='tanque'+id;
    Marcador = new google.maps.Marker({
        position: new google.maps.LatLng(document.getElementById(id).getAttribute('data-lat'),document.getElementById(id).getAttribute('data-lng')),
        map: map,
        icon: image,
        id:id.replace('tanque',''),
        nombre:document.getElementById(id).name,
        visible:false
      });
    Marcador.setMap(map);
    Marcador.info= new google.maps.InfoWindow({
    content:""+document.getElementById(id).name+""
  });
  google.maps.event.addListener(Marcador, 'click', function(event) {
    if (event) {
      point = event.latLng;
    }
    this.info.setPosition(point);
    this.info.open(map);
   }); 
    Minfrar.push(Marcador);
  }
}
/**
 * Oculta la infraestructura de regularización seleccionada
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
function ocultarinfrar(id){
  for(var i=0;i<Minfrar.length;i++){
    if(Minfrar[i].id==id){
     Minfrar[i].setOptions({
    visible:false});
    }
  }
} 
/**
 * Muestra la infraestructura de regularización seleccionada
 * @param  {[type]} id  [description]
 * @param  {[type]} dis [description]
 * @return {[type]}     [description]
 */
function mostrarinfrar(id,dis){
  var ban=0;
  for(var i=0;i<Poligonos.length;i++){
    if(Poligonos[i].id==dis&&Poligonos[i].tipo=='Distrito'&& Poligonos[i].visible){
     ban=1;
    }
  }
  for(i=0;i<Minfrar.length;i++){
    if(Minfrar[i].id==id && ban==1){
     Minfrar[i].setOptions({
    visible:true});
    }
    else if(Minfrar[i].id==id && ban==0){
      Minfrar[i].setOptions({
    visible:false});
    }
  }
}
/**
 * Carga los pozos al mapa
 * @return {[type]} [description]
 */
function cargarpozos(){
  var image="../img/map/pozo1.png";
  for(var i=1;i<=document.getElementById('pozosnum').value;i++){
    var id=document.getElementById('pozos'+i).value;
    id='pozo'+id;
    idaux=document.getElementById(id).getAttribute('data-id2');
    Marcador = new google.maps.Marker({
        position: new google.maps.LatLng(document.getElementById(id).getAttribute('data-lat'),document.getElementById(id).getAttribute('data-lng')),
        map: map,
        icon: image,
        nombre:document.getElementById(id).name,
        id2:idaux,
        id:id.replace('pozo',''),
        visible:false
      });
    Marcador.setMap(map);
    Marcador.info= new google.maps.InfoWindow({
    content:""+document.getElementById(id).name+""
  });
  google.maps.event.addListener(Marcador, 'click', function(event) {
    if (event) {
      point = event.latLng;
    }
    this.info.setPosition(point);
    this.info.open(map);
   }); 
    Mpozos.push(Marcador);
  }
}
/**
 * Oculta los pozos
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
function ocultarpozo(id){
  for(var i=0;i<Mpozos.length;i++){
    if(Mpozos[i].id==id){
     Mpozos[i].setOptions({
    visible:false});
    }
  }
}
/**
 * Muestra los pozos
 * @param  {[type]} id  [description]
 * @param  {[type]} dis [description]
 * @return {[type]}     [description]
 */
function mostrarpozo(id,dis){
  var ban=0;
  for(var i=0;i<Poligonos.length;i++){
    if(Poligonos[i].id==dis&&Poligonos[i].tipo=='Distrito'&& Poligonos[i].visible){
     ban=1;
    }
  }
  for(i=0;i<Mpozos.length;i++){
    if(Mpozos[i].id==id && ban==1){
     Mpozos[i].setOptions({
    visible:true});
    }
    else if(Mpozos[i].id==id){
      Mpozos[i].setOptions({
    visible:false});
    }
  }
} 

function cargarvalvulas(){
  var image="../img/map/valvula.png";
  for(var i=1;i<=document.getElementById('valvulsnum').value;i++){
    var id=document.getElementById('valvuls'+i).value;
    id='valvul'+id;
    Marcador = new google.maps.Marker({
        position: new google.maps.LatLng(document.getElementById(id).getAttribute('data-lat'),document.getElementById(id).getAttribute('data-lng')),
        map: map,
        icon: image,
        nombre:document.getElementById(id).name,
        id:id.replace('valvul',''),
        visible:false
      });
    Marcador.setMap(map);
    Marcador.info= new google.maps.InfoWindow({
    content:""+document.getElementById(id).name+""
  });
  google.maps.event.addListener(Marcador, 'click', function(event) {
    if (event) {
      point = event.latLng;
    }
    this.info.setPosition(point);
    this.info.open(map);
   }); 
    Mvalvulas.push(Marcador);
  }
}

function ocultarvalvula(id){
  for(var i=0;i<Mvalvulas.length;i++){
    if(Mvalvulas[i].id==id){
     Mvalvulas[i].setOptions({
    visible:false});
    }
  }
}

function mostrarvalvula(id,dis){
  var ban=0;
  for(var i=0;i<Poligonos.length;i++){
    if(Poligonos[i].id==dis&&Poligonos[i].tipo=='Distrito'&& Poligonos[i].visible){
     ban=1;
    }
  }
  for(i=0;i<Mvalvulas.length;i++){
    if(Mvalvulas[i].id==id && ban==1){
     Mvalvulas[i].setOptions({
    visible:true});
    }
    else if(Mvalvulas[i].id==id){
      Mvalvulas[i].setOptions({
    visible:false});
    }
  }
} 


function cargarbombeos(){
  var image="../img/map/bomba.png";
  for(var i=1;i<=document.getElementById('bombeonum').value;i++){
    var id=document.getElementById('bombeos'+i).value;
    id='bombeo'+id;
    Marcador = new google.maps.Marker({
        position: new google.maps.LatLng(document.getElementById(id).getAttribute('data-lat'),document.getElementById(id).getAttribute('data-lng')),
        map: map,
        icon: image,
        nombre:document.getElementById(id).name,
        id:id.replace('bombeo',''),
        visible:false
      });
    Marcador.setMap(map);
    Marcador.info= new google.maps.InfoWindow({
    content:""+document.getElementById(id).name+""
  });
  google.maps.event.addListener(Marcador, 'click', function(event) {
    if (event) {
      point = event.latLng;
    }
    this.info.setPosition(point);
    this.info.open(map);
   }); 
    Mbombeo.push(Marcador);
  }
}

function ocultarbombeo(id){
  for(var i=0;i<Mbombeo.length;i++){
    if(Mbombeo[i].id==id){
     Mbombeo[i].setOptions({
    visible:false});
    }
  }
}

function mostrarbombeo(id,dis){
  var ban=0;
  for(var i=0;i<Poligonos.length;i++){
    if(Poligonos[i].id==dis&&Poligonos[i].tipo=='Distrito'&& Poligonos[i].visible){
     ban=1;
    }
  }
  for(i=0;i<Mbombeo.length;i++){
    if(Mbombeo[i].id==id && ban==1){
     Mbombeo[i].setOptions({
    visible:true});
    }
    else if(Mbombeo[i].id==id){
      Mbombeo[i].setOptions({
    visible:false});
    }
  }
}  

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
          Materialize.toast('Haga clic en el distrito para ver su detalle', 10000);
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
        $('#').text('ID: '+id);
        $('#Mdis').text('Circuito: '+nombre);
        $('#muestra-distrito').click();*/
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