<?php
/*
Plugin Name: Nombre del plugin
Plugin URI: http://URI_De_La_Página_Que_Describe_el_Plugin_y_Actualizaciones
Description: Una breve descripción del plugin.
Version: El número de versión del plugin e.j.: 1.0
Author: Nombre del autor del plugin
Author URI: http://URI_del_Autor_del_Plugin
License: Un nombre de licencia "pegadizo" e.j. GPL2
*/
?>

<?php
function theme_options_panel(){
  add_menu_page('Herramientas Estadisticas', 'Herramientas Estadisticas', 'manage_options', 'theme-options', 'wps_theme_func');
  //add_submenu_page( 'theme-options', 'Settings page title', 'Settings menu label', 'manage_options', 'theme-op-settings', 'wps_theme_func_settings');
  add_submenu_page( 'theme-options', 'Estadísticas de Actividad', 'Estadísticas de Actividad', 'manage_options', '/admin.php?page=act_stats', '');
  add_submenu_page( 'theme-options', 'Actividad Usuarios', 'Actividad de Usuarios', 'manage_options', '/admin.php?page=act_activity', '');
  add_submenu_page( 'theme-options', 'Actividad por País', 'Actividad por País', 'manage_options', 'theme-options-settings', 'wps_theme_func_settings');
  add_submenu_page( 'theme-options', 'Actividad por Contenido', 'Actividad por Contenido', 'manage_options', 'por_contenido', 'por_contenido_vista');
}
add_action('admin_menu', 'theme_options_panel');

function wps_theme_func(){
		include_once 'tema.php';
}
function wps_theme_func_settings(){
		include_once 'actividad_por_pais.php';
}

function por_contenido_vista()
{
	include_once 'actividad_por_contenido.php';

}	


?>