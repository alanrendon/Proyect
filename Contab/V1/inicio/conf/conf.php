<?php

if ( is_session_started_conf() === FALSE ) @session_start();

if(isset($_SESSION['ENTITY'])){
    $ENTITY= (int)$_SESSION['ENTITY'];
}else{
    $ENTITY=1;
}


define('DB_HOST','localhost');
define('DB_USER','root'); //usuario de la base de datos
define('DB_PASS','');  //contraseña de la base de datos
define('DB_NAME','dolibarr3921');  //nombre de la base de datos
define('DB_CHARSET','utf-8');
define('IMG_ROOT','http://contab.grupoauribox.com/Aieme/dolibarr/htdocs/viewimage.php?cache=1&modulepart=companylogo&file=thumbs%2FPetroChina-Logo_mini.png');
define('PREFIX','llx_');

#Ejemplo de URL, favor de omitir el último /
define('DOL_URL','http://contab.grupoauribox.com/Aieme/dolibarr/htdocs');
define('ENTITY',$ENTITY);
define('HIDOLI',0); //Ocultar divs de relación de facturas cliente/proveedor

function is_session_started_conf()
{
            if ( php_sapi_name() !== 'cli' ) {
                if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                    return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
                } else {
                    return session_id() === '' ? FALSE : TRUE;
                }
            }
}

?>