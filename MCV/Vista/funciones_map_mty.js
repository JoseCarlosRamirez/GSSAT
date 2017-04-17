/**
 * Funcion que carga los formularios de acuerdo a la opcion seleccionada
 * @return {[type]} [description]
 */
function loadmapOptions(value){
    var opcion = validate(value);
    if(opcion != false){
        switch(opcion){
            case "Sector-r":
              $('#irextra').click();
              break;
            case "Distrito-r":
              $('#irextra').click();
              break;
            case "Subsector-r":
              $('#irextra').click();
              break;  
            case "Tanque-r":
              $('#irextra').click();
              break;
            case "Arrancador-r":
              $('#abre-arrancador').click();
              break;
            case "Bomba-r":
              $('#abre-bomba').click();
              break;
            case "Capacitores-r":
              $('#abre-capacitores').click();
              break;
            case "ConductorElectrico-r":
              $('#abre-conductorelectrico').click();
              break;
            case "Bombeo-r":
              $('#irextra').click();
              break;
            case "Valvula-r":
              $('#irextra').click();
              break;
            case "Pozo-r":
              $('#irextra').click();
              break;
             case "Tuberia-r":
              $('#abre-tuberia').click();
              break;    
       }
    }
    else{
    	alert("Opción no valida, intente de nuevo.");
    }
}
    var id_entrada=0;
    var id_salida=0;
    var id_per=0;
    var band=0;
    /**
     * Valida el elemento que se eligio para la entrada y se muestra el select correspondiente
     * @param  {[type]} item [elemento seleccionado]
     * @return {[type]}      [description]
     */
    function validateSele(item){
      if(item.localeCompare("Bomba")==0){
        document.getElementById('id_1_1').style.display = 'block';
        document.getElementById('id_1_2').style.display = 'none';
        document.getElementById('id_1_3').style.display = 'none';
        document.getElementById('id_1_4').style.display = 'none';
        document.getElementById('id_1_5').style.display = 'none';
      }
      if(item.localeCompare("Tanque")==0){
        document.getElementById('id_1_1').style.display = 'none';
        document.getElementById('id_1_2').style.display = 'block';
        document.getElementById('id_1_3').style.display = 'none';
        document.getElementById('id_1_4').style.display = 'none';
        document.getElementById('id_1_5').style.display = 'none';
      }
      if(item.localeCompare("Sector")==0){
        document.getElementById('id_1_1').style.display = 'none';
        document.getElementById('id_1_2').style.display = 'none';
        document.getElementById('id_1_3').style.display = 'block';
        document.getElementById('id_1_4').style.display = 'none';
        document.getElementById('id_1_5').style.display = 'none';
      }
      if(item.localeCompare("Subsector")==0){
        document.getElementById('id_1_1').style.display = 'none';
        document.getElementById('id_1_2').style.display = 'none';
        document.getElementById('id_1_3').style.display = 'none';
        document.getElementById('id_1_4').style.display = 'block';
        document.getElementById('id_1_5').style.display = 'none';
      }
      if(item.localeCompare("Distrito")==0){
        document.getElementById('id_1_1').style.display = 'none';
        document.getElementById('id_1_2').style.display = 'none';
        document.getElementById('id_1_3').style.display = 'none';
        document.getElementById('id_1_4').style.display = 'none';
        document.getElementById('id_1_5').style.display = 'block';
      }
    }
    /**
     * Recibe el elemento seleccionado para la entrada cuando cambia su valor y lo valida
     * @param  {[type]} )
     * @return {[type]}     [description]
     */
    $("#entrada_val").change(function(){
        validateSele($('select[id=entrada_val]').val());
    });
    /**
     * Valida el elemento que se eligio para la salida y se muestra el select correspondiente
     * @param  {[type]} item [description]
     * @return {[type]}      [description]
     */
    function validateSeles(item){
      if(item.localeCompare("Bomba")==0){
        document.getElementById('id_2_1').style.display = 'block';
        document.getElementById('id_2_2').style.display = 'none';
        document.getElementById('id_2_3').style.display = 'none';
        document.getElementById('id_2_4').style.display = 'none';
        document.getElementById('id_2_5').style.display = 'none';
      }
      if(item.localeCompare("Tanque")==0){
        document.getElementById('id_2_1').style.display = 'none';
        document.getElementById('id_2_2').style.display = 'block';
        document.getElementById('id_2_3').style.display = 'none';
        document.getElementById('id_2_4').style.display = 'none';
        document.getElementById('id_2_5').style.display = 'none';
      }
      if(item.localeCompare("Sector")==0){
        document.getElementById('id_2_1').style.display = 'none';
        document.getElementById('id_2_2').style.display = 'none';
        document.getElementById('id_2_3').style.display = 'block';
        document.getElementById('id_2_4').style.display = 'none';
        document.getElementById('id_2_5').style.display = 'none';
      }
      if(item.localeCompare("Subsector")==0){
        document.getElementById('id_2_1').style.display = 'none';
        document.getElementById('id_2_2').style.display = 'none';
        document.getElementById('id_2_3').style.display = 'none';
        document.getElementById('id_2_4').style.display = 'block';
        document.getElementById('id_2_5').style.display = 'none';
      }
      if(item.localeCompare("Distrito")==0){
        document.getElementById('id_2_1').style.display = 'none';
        document.getElementById('id_2_2').style.display = 'none';
        document.getElementById('id_2_3').style.display = 'none';
        document.getElementById('id_2_4').style.display = 'none';
        document.getElementById('id_2_5').style.display = 'block';
      }
    }
    /**
     * Recibe el elemento seleccionado para la salida cuando cambia su valor y lo valida
     * @param  {[type]} ){                     validateSeles($('select[id [description]
     * @return {[type]}     [description]
     */
    $("#salida_val").change(function(){
        validateSeles($('select[id=salida_val]').val());
    });
    /**
     * Envia los valores de entrada y salida al formulario antes de registrarlo
     * @return {[type]} [description]
     */
    function enviarval(){
      validateSelecte($('select[id=entrada_val]').val());
      validateSelects($('select[id=salida_val]').val());
      document.getElementById('id_entr').value=id_entrada;
      document.getElementById('id_sal').value=id_salida;
      javascript:document.fvalvula.submit();
    }
    /**
     * Valida el elemento que se eligio para la entrada y lo asigna a una variable
     * @param  {[type]} item [description]
     * @return {[type]}      [description]
     */
    function validateSelecte(item){
      if(item.localeCompare("Bomba")==0){
        id_entrada=$('#id1_1').val();
      }
      if(item.localeCompare("Tanque")==0){
        id_entrada=$("#id1_2").val();
      }
      if(item.localeCompare("Sector")==0){
        id_entrada=$("#id1_3").val();
      }
      if(item.localeCompare("Subsector")==0){
        id_entrada=$("#id1_4").val();
      }
      if(item.localeCompare("Distrito")==0){
        id_entrada=$("#id1_5").val();
      }
    }
    /**
     * Valida el elemento que se eligio para la salida y lo asigna a una variable
     * @param  {[type]} item [description]
     * @return {[type]}      [description]
     */
    function validateSelects(item){
      if(item.localeCompare("Bomba")==0){
        id_salida=$('#id2_1').val();
      }
      if(item.localeCompare("Tanque")==0){
        id_salida=$("#id2_2").val();
      }
      if(item.localeCompare("Sector")==0){
        id_salida=$("#id2_3").val();
      }
      if(item.localeCompare("Subsector")==0){
        id_salida=$("#id2_4").val();
      }
      if(item.localeCompare("Distrito")==0){
        id_salida=$("#id2_5").val();
      }
    }
    /**
     * Valida el elemento que se eligio para el distrito y se muestra el select correspondiente
     * @param  {[type]} item [description]
     * @return {[type]}      [description]
     */
    function validateSeled(item){
      if(item.localeCompare("Sector")==0){
        document.getElementById('ids').style.display = 'block';
        document.getElementById('idss').style.display = 'none';
        }
      if(item.localeCompare("Subsector")==0){
        document.getElementById('idss').style.display = 'block';
        document.getElementById('ids').style.display = 'none';
      }
    }
    $("#id_per").change(function(){
        validateSeled($('select[id=id_per]').val());
    });
    /**
     * Recibe el elemento seleccionado para el distrito cuando cambia su valor y lo valida
     * @param  {[type]} ){                     validateSeles($('select[id [description]
     * @return {[type]}     [description]
     */
    function validateSelectdis(item){
      if(item.localeCompare("Sector")==0){
        id_per=$('#id_sect').val();
        band=0;
        }
      if(item.localeCompare("Subsector")==0){
        id_per=$('#id_sub').val();
        band=1;
      }
    }
    /**
     * Envia los valores de si el distrito pertenece a un sector o un subsector y su respectivo id al formulario antes de registrarlo
     * @return {[type]} [description]
     */
    function enviardis(){
      validateSelectdis($('select[id=id_per]').val());
      document.getElementById('idper').value=id_per;
      document.getElementById('band').value=band;
      asigncolor(1);
      javascript:document.fdis.submit();
    }
    /**
     * asigna el color de linea y de fondo dependiendo del formulario que se este llenando
     * @param  {[type]} id [description]
     * @return {[type]}    [description]
     */
    function asigncolor(id){
      switch(id){
        case 1:
          document.getElementById('clinea1_1').value=document.getElementById('clinea1').getAttribute(value);
          document.getElementById('crrelleno1_1').value=document.getElementById('crrelleno1').getAttribute(value);
          break;
        case 2:
          document.getElementById('clinea2_1').value=document.getElementById('clinea2').getAttribute(value);
          document.getElementById('crrelleno2_1').value=document.getElementById('crrelleno2').getAttribute(value);
          javascript:document.fsub.submit();
          break;
        case 3:
          document.getElementById('clinea3_1').value=document.getElementById('clinea3').getAttribute(value);
          document.getElementById('crrelleno3_1').value=document.getElementById('crrelleno3').getAttribute(value);
          javascript:document.fsa.submit();
          break;  
      }
    }


    function select_zona(item, value){
      var value2=document.getElementById(value).id;
      var tipo=$("#"+value2).attr('class');
      if(document.getElementById(value).checked){
        $("."+item).prop("checked", "checked");
      }
      else {
        $("."+item).prop("checked", false);
      }
      switch(tipo){
        case 'tanque':
        checkinfrar(value);
        break;
        case 'pozo':
        checkpozos(value);
        break;
        case 'valvula':
        checkvalvulas(value);
        break;
        case 'bomba':
        checkbombeos(value);
        break;
      }
        recorrido_zona(value);
    }
    

    function recorrido_zona(value){
      var elementos = new Array();
      var elementos = document.getElementsByClassName(value);
      if(1 < elementos.length){
        for (var i = 0; i < elementos.length; i++) {
          if(document.getElementById(value).checked){
         $('#'+elementos[i].id).prop("checked", "checked");

        }
        else {
         $('#'+elementos[i].id).prop("checked", false);
          }
          select_zona(elementos[i].id,elementos[i].id);
        }  
      }
      
    }
    /**
     * Maneja un arreglo que define si se oculta o se muestra un poligono en el mapa
     * @param  {[type]} value [description]
     * @return {[type]}       [description]
     */
    function polihandler(value){
      filas=document.getElementsByClassName(value);
      for (i=0; i<filas.length; i++) {
      if(document.getElementById(filas[i].id).id!='null'){
        checkinfrapoli('tanque');
        checkinfrapoli('pozo');
        checkinfrapoli('valvula');
        checkinfrapoli('bomba');
        if(document.getElementById(filas[i].id).indeterminate){
         if(filas[i].getAttribute('data-seccion').localeCompare('sector')==0){
            ocultarpoli(filas[i].getAttribute('data-id'),'Sector');
          }
          if(filas[i].getAttribute('data-seccion').localeCompare('subsector')==0){
            ocultarpoli(filas[i].getAttribute('data-id'),'Subsector');
          }
          if(filas[i].getAttribute('data-seccion').localeCompare('distrito')==0){
            ocultarpoli(filas[i].getAttribute('data-id'),'Distrito');
          }
        }
        if(document.getElementById(filas[i].id).checked){
          if(filas[i].getAttribute('data-seccion').localeCompare('sector')==0){
            mostrarpoli(filas[i].getAttribute('data-id'),'Sector');
          }
          if(filas[i].getAttribute('data-seccion').localeCompare('subsector')==0){
            mostrarpoli(filas[i].getAttribute('data-id'),'Subsector');
          }
          if(filas[i].getAttribute('data-seccion').localeCompare('distrito')==0){
            mostrarpoli(filas[i].getAttribute('data-id'),'Distrito');
          }
        }
        if(!document.getElementById(filas[i].id).checked || document.getElementById(filas[i].id).indeterminate){
          if(filas[i].getAttribute('data-seccion').localeCompare('sector')==0){
            ocultarpoli(filas[i].getAttribute('data-id'),'Sector');
          }
          if(filas[i].getAttribute('data-seccion').localeCompare('subsector')==0){
            ocultarpoli(filas[i].getAttribute('data-id'),'Subsector');
          }
          if(filas[i].getAttribute('data-seccion').localeCompare('distrito')==0){
            ocultarpoli(filas[i].getAttribute('data-id'),'Distrito');
          }
        }
      }
      }
}

    function checket(value, item){
      if(document.getElementById(value).checked){
          $("."+item).prop("checked", "checked");
        }
        else {
          $("."+item).prop("checked", false);
        }
    }

      /**
     * Funcion que permite filtrar la informacion del checkbox. Esta funcion establece los estados como "indeterminado"
     * @param  {String} Recibe el nombre del elemento que se va a filtrar
     * @return {[type]}
     */
    function indetAction(value){
      if(value=="zonas"){
        //checked_all(value);
        return 0;
      }
      var a = 0; var ban = 0;
      all = document.getElementById(value).className;
      var boxes = document.getElementsByClassName(all);
      for (var i = 0; i < boxes.length; i++) {
        //alert($("#ocotepec").prop("checked"));
        if($("#"+boxes[i].id).prop("checked") && $("#"+boxes[i].id).prop("indeterminate")==false){
          a++;
        }
        if($("#"+boxes[i].id).prop("indeterminate")){
          var box = document.getElementById(all);
          box.indeterminate = true;
          if(box.getAttribute('data-seccion').localeCompare('sector')==0){
            ocultarpoli(box.getAttribute('data-id'),'Sector');
          }
          if(box.getAttribute('data-seccion').localeCompare('subsector')==0){
            ocultarpoli(box.getAttribute('data-id'),'Subsector');
          }
          if(box.getAttribute('data-seccion').localeCompare('distrito')==0){
            ocultarpoli(box.getAttribute('data-id'),'Distrito');
          }
          document.getElementById('zonas').indeterminate = true;
          ban = 1;
        }
      }
      //alert(boxes.length+" -- "+a);
      if(a < boxes.length){
        var box = document.getElementById(all);
        box.indeterminate = true;
        if(box.getAttribute('data-seccion').localeCompare('sector')==0){
            ocultarpoli(box.getAttribute('data-id'),'Sector');
          }
        if(box.getAttribute('data-seccion').localeCompare('subsector')==0){
            ocultarpoli(box.getAttribute('data-id'),'Subsector');
          }
        if(box.getAttribute('data-seccion').localeCompare('distrito')==0){
            ocultarpoli(box.getAttribute('data-id'),'Distrito');
          }
        document.getElementById('zonas').indeterminate = true;
      }
      if(a == boxes.length && ban==0){
        var box = document.getElementById(all);
        box.indeterminate = false;
        document.getElementById(all).checked = true;
      }
      if(a == 0 && ban == 0){
        var box = document.getElementById(all);
        box.indeterminate = false;
        document.getElementById(all).checked = false;
      }
      polihandler(all);
      indetAction(all);
    }

    function select_random(item,value){  
      if(document.getElementById(value).checked){
        $("."+item).prop("checked", "checked");
      }
      else {
        $("."+item).prop("checked", false);
      }
      polihandler(value);
      var elementos = new Array();
      var elementos = document.getElementsByClassName(value);
      for (var i = 0; i < elementos.length; i++) {
          polihandler(elementos[i].id);
      }
    }

    function select_sector(item, value){
    if(document.getElementById(value).checked){
      $("."+item).prop("checked", "checked");
        //select_random(item,value);
    }
    else {
      $("."+item).prop("checked", false);
    }
    var elementos = new Array();
    var elementos = document.getElementsByClassName(value);
    polihandler(value);
    for (var i = 0; i < elementos.length; i++) {
      select_random(elementos[i].name,elementos[i].name);
    }
    }
    /**
     * Recorre todo el arbol activando o desactivando todos los elementos según sea el caso
     * @param  {[type]} value [description]
     * @return {[type]}       [description]
     */
     function checked_all(value){
      filas=document.getElementsByClassName(value);
      for (var i=0; i<filas.length; i++) {
         
      if(document.getElementById(value).checked){
         $('#'+filas[i].id).prop("checked", "checked");
        }
        else {
         $('#'+filas[i].id).prop("checked", false);
          }
        
      }
      polihandler(value);  
      recorrido_checked(value);  
    }
    /**
     * recorrido adicional a la hora de activar o desactivar todo el arbol
     * @param  {[type]} value [description]
     * @return {[type]}       [description]
     */
    function recorrido_checked(value){
      var elementos = new Array();
      var elementos = document.getElementsByClassName(value);
      if(elementos.length > 0){
        for (var i = 0; i < elementos.length; i++) {
          checked_all(elementos[i].id);
        }  
      }
      
    }
    /**
     * Maneja si se muestra o no un poligono si se activa o se desactiva individualmente
     * @param  {[type]} value [description]
     * @return {[type]}       [description]
    */
    function polihandler1(value){
      if(document.getElementById(value).id!='null'){
        
        checkinfrapoli('tanque');
        checkinfrapoli('pozo');
        checkinfrapoli('valvula');
        checkinfrapoli('bomba');
        value2=document.getElementById(value);
        if(document.getElementById(value).indeterminate){
         if(value2.getAttribute('data-seccion').localeCompare('sector')==0){
            ocultarpoli(value2.getAttribute('data-id'),'Sector');
          }
          if(value2.getAttribute('data-seccion').localeCompare('subsector')==0){
            ocultarpoli(value2.getAttribute('data-id'),'Subsector');
          }
          if(value2.getAttribute('data-seccion').localeCompare('distrito')==0){
            ocultarpoli(value2.getAttribute('data-id'),'Distrito');
          }
        }
        if(document.getElementById(value).checked){
          if(value2.getAttribute('data-seccion').localeCompare('sector')==0){
            mostrarpoli(value2.getAttribute('data-id'),'Sector');
          }
          if(value2.getAttribute('data-seccion').localeCompare('subsector')==0){
            mostrarpoli(value2.getAttribute('data-id'),'Subsector');
          }
          if(value2.getAttribute('data-seccion').localeCompare('distrito')==0){
            mostrarpoli(value2.getAttribute('data-id'),'Distrito');
          }
        }
        if(!document.getElementById(value).checked || document.getElementById(value).indeterminate){
          if(value2.getAttribute('data-seccion').localeCompare('sector')==0){
            ocultarpoli(value2.getAttribute('data-id'),'Sector');
          }
          if(value2.getAttribute('data-seccion').localeCompare('subsector')==0){
            ocultarpoli(value2.getAttribute('data-id'),'Subsector');
          }
          if(value2.getAttribute('data-seccion').localeCompare('distrito')==0){
            ocultarpoli(value2.getAttribute('data-id'),'Distrito');
          }
        }
      }
      
}

/**
 * Obtiene los datos seleccionados por el usuario para luego mandar llamar la función de lo que se desea eliminar
 * @return {[type]} [description]
 */
function elimpoli(){
  var tipo=document.getElementById('tipoPoli').textContent;
  var nombre=document.getElementById('nombrePoli').textContent;
  var id=document.getElementById('idPoli').textContent;
  tipo=tipo.replace('Tipo: ','');
  nombre=nombre.replace('Nombre: ','');
  id=id.replace('ID: ','');
  nombre=nombre.replace(' ','_');
  switch(tipo){
    case "Sector":
      document.location='http://172.16.3.12/GISSAT/delete_Controller/borrar_sa/'+id+"/"+nombre;
    break;
    case "Subsector":
      document.location='http://172.16.3.12/GISSAT/delete_Controller/borrar_subsector/'+id+"/"+nombre;
    break;
    case "Distrito":
      document.location='http://172.16.3.12/GISSAT/delete_Controller/borrar_distrito/'+id+"/"+nombre;
    break;
    case "Tanque":
      document.location='http://172.16.3.12/GISSAT/delete_Controller/borrar_tanque/'+id;
    break;
    case "Pozo":
      var id2=document.getElementById('id2').value;
      document.location='http://172.16.3.12/GISSAT/delete_Controller/borrar_pozo/'+id+"/"+id2;
    break;
    case "Valvula":
      document.location='http://172.16.3.12/GISSAT/delete_Controller/borrar_valvula/'+id;
    break;
    case "Bombeo":
      document.location='http://172.16.3.12/GISSAT/delete_Controller/borrar_bombeo/'+id;
    break;
  }
   
}

function editpoli(tipo){
  
  switch(tipo){
    case "Sector":
    asigncolor(3);
    break;
    case "Subsector":
    asigncolor(2);
    break;
    case "Distrito":
    enviardis();
    break;
    case "Pozo":
    
    break;
    case "Tanque":
    
    break;
    case "Valvula":
    
    break;
  }

}
/**
 * Dependiendo del estado del checkbox se oculta o se muestra
 * @param  {[type]} value [description]
 * @return {[type]}       [description]
 */
function checkinfrar(value){
  var value2=document.getElementById(value);
  if(document.getElementById(value).checked){
          $(""+value).prop("checked", "checked");
          mostrarinfrar(value2.getAttribute('data-id'),value2.getAttribute('data-dis'));
        }
        else {
          $(""+value).prop("checked", false);
          ocultarinfrar(value2.getAttribute('data-id'));
        }
}

function checkpozos(value){
  var value2=document.getElementById(value);
  if(document.getElementById(value).checked){
          $(""+value).prop("checked", "checked");
          mostrarpozo(value2.getAttribute('data-id'),value2.getAttribute('data-dis'));
        }
        else {
          $(""+value).prop("checked", false);
          ocultarpozo(value2.getAttribute('data-id'));
        }
}

function checkvalvulas(value){
  var value2=document.getElementById(value);
  if(document.getElementById(value).checked){
          $(""+value).prop("checked", "checked");
          mostrarvalvula(value2.getAttribute('data-id'),value2.getAttribute('data-dis'));
        }
        else {
          $(""+value).prop("checked", false);
          ocultarvalvula(value2.getAttribute('data-id'));
        }
}

function checkbombeos(value){
  var value2=document.getElementById(value);
  if(document.getElementById(value).checked){
          $(""+value).prop("checked", "checked");
          mostrarbombeo(value2.getAttribute('data-id'),value2.getAttribute('data-dis'));
        }
        else {
          $(""+value).prop("checked", false);
          ocultarbombeo(value2.getAttribute('data-id'));
        }
}

function checkinfra(tipo,value){
  switch(tipo){
        case 'tanque':
        checkinfrar(value);
        break;
        case 'pozo':
        checkpozos(value);
        break;
        case 'valvula':
        checkvalvulas(value);
        break;
        case 'bomba':
        checkbombeos(value);
        break;
      }
}

function checkinfrapoli(tipo){
  var lista=document.getElementsByClassName(tipo);
  for(var i=0;i <  lista.length;i++){
    checkinfra(tipo,lista[i].id);
  }
}