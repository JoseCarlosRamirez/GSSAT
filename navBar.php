<?php  
  class navBar{

    /**
     * Carga todas las opciones en el NavBar
     * @return [type] [description]
     */
    function menu(){
      echo "<nav class='white' role='navigation'>
          <div class='nav-wrapper container'>
            <a id='logo-container' class='brand-logo' href='map'><img src='../img/Empresa/Logo.png' alt='' style='height: 48px;'></a>
            <ul class='right hide-on-med-and-down'>
              <li><a href='map'>Mapa</a></li>
              <li><a href='data'>Producción</a></li>
              <li><a href='temporal'>Consumo</a></li>
              <li><a href=''>Fugas</a></li>
              <li><a href=''>Consumo Electrico</a></li>
              <li><a href=''>Telemetría</a></li>
              <li ><a href=''><i class='medium material-icons' title='Ayuda' style='color: black;'>help</i></a></li>
              <li ><a href='registro_pozos.php'><i class='medium material-icons' title='Usuario' style='color: black;'>supervisor_account</i></a></li>
              <li ><a href='".base_url()."Gissat/Ajustes' class=''><i class='medium material-icons' title='Ajustes' style='color: black;'>settings</i></a></li>
              <li ><a href=''><i class='medium material-icons' title='Cerrar sesion' style='color: black;'>input</i></a></li>
              </ul>
          </div>
        </nav>
         <ul id='menu_ajustes' class='dropdown-content' style='width: 0px; top: 0px;'>
          <li><a href='#!' style='font-size: 13px;'>Ajustes generales</a></li>
          <li><a href='#!' style='font-size: 13px;'>Campaña de medición</a></li>
          <li><a href='#!' style='font-size: 13px;'>Respaldo</a></li>
          <li><a href='#!' style='font-size: 13px;'>Recuperación</a></li>
        </ul>
        ";
    }

    /**
     * Carga todas las opciones en el NavBar y muestra la ubicacion actual
     * @return [type] [description]
     */
    function map(){
      echo "<nav class='white' role='navigation'>
          <div class='nav-wrapper container'>
            <a id='logo-container' class='brand-logo' href='map'><img src='../img/Empresa/Logo.png' alt='' style='height: 48px; width: 90px;'></a>
            <ul class='right hide-on-med-and-down'>
              <li class='active teal accent-3'><a href=''>Mapa</a></li>
              <li><a href='data'>Producción</a></li>
              <li><a href='temporal'>Consumo</a></li>
              <li><a href=''>Fugas</a></li>
              <li><a href='".base_url()."Gissat/Menu_gestion'>Consumo Electrico</a></li>
              <li><a href=''>Telemetría</a></li>
              <li ><a href=''><i class='medium material-icons' title='Ayuda'><img src='../img/system/help.png' style='height: 30px;'></i></a></li>
              <li ><a href='registro_pozos.php'><i class='medium material-icons' title='Usuario' style='color: black;'>supervisor_account</i></a></li>
              <li ><a href='".base_url()."Gissat/Ajustes'><i class='medium material-icons' title='Ajustes' style='color: black;'>settings</i></a></li>
              <li ><a href='../user_controller/logout'><i class='medium material-icons' title='Cerrar sesion'><img src='../img/system/logout.png' id='img-logout'></i></a></li>
              </ul>
          </div>
        </nav>";
    }
/*<?php echo base_url() ?>gissat/map */
    /**
     * Carga todas las opciones en el NavBar y muestra la ubicacion actual
     * @return [type] [description]
     */
    function production(){
      echo "<nav class='white' role='navigation'>
          <div class='nav-wrapper container'>
            <a id='logo-container' class='brand-logo' href='map'><img src='/GSSAT/img/Empresa/Logo.png' alt='' style='height: 48px;'></a>
            <ul class='right hide-on-med-and-down'>
              <li><a href='map'>Mapa</a></li>
              <li class='active teal accent-3'><a href=''>Producción</a></li>
              <li><a href=''>Consumo</a></li>
              <li><a href=''>Fugas</a></li>
              <li><a href=''>Consumo Electrico</a></li>
              <li><a href=''>Telemetría</a></li>
              <li ><a href=''><i class='medium material-icons' title='Ayuda'><img src='../img/system/help.png' style='height: 30px;'></i></a></li>
              <li ><a href='registro_pozos.php'><i class='medium material-icons' title='Usuario' style='color: black;'>supervisor_account</i></a></li>
              <li ><a href='".base_url()."Gissat/Ajustes'><i class='medium material-icons' title='Ajustes' style='color: black;'>settings</i></a></li>
              <li ><a href=''><i class='medium material-icons' title='Cerrar sesion'><img src='../img/system/logout.png' id='img-logout'></i></a></li>
              </ul>
          </div>
        </nav>";  
    }


    /**
     * Cargar todos los complementos CSS para la visualizacion de la pagina. Solo los generales.
     * @return [type] [description]
     */
    function generalStyle(){
      echo "<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
            <link href='../css/imgStyle.css' type='text/css' rel='stylesheet' media='screen,projection'/>
            <link href='../css/materialize.css' type='text/css' rel='stylesheet' media='screen,projection'/>
            <link href='../css/style.css' type='text/css' rel='stylesheet' media='screen,projection'/>
            <link href='../css/map.css' type='text/css' rel='stylesheet' media='screen,projection'/>
            <link href='../css/textStyle.css' type='text/css' rel='stylesheet' media='screen,projection'/>";

    }

    /**
     * Barra de opciones generales. Parte inferior.
     * @return [type] [description]
     */
    function footer(){
      echo " 
      <footer >
        <nav class='grey' role='navigation'>
          <div class='nav-wrapper container'>
            <ul class='right hide-on-med-and-down'>
              <li><a href='../php/map.php'>Auditoria</a></li>
              <li><a href=''>Balance</a></li>
              <li><a href=''>Eficiencia hidraulica</a></li>
              <li><a href=''>Eficiencia Electromecanica</a></li>
              <li><a href=''>EPANET</a></li>
              <li><a href=''>Reportes</a></li>
              </ul>
          </div>
        </nav>
      </footer>";
    }
	}
?>