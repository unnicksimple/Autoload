<?php
/**
 * IMPORTANTE:
 * En esta version los namespace utilizaran obligatoriamente la ruta en donde se encuentra la clase
 * Ej de ruta de directorios app/controller/MiClase.php 
 * Ej de namespace para esa clase namespace app\controller;
 */
spl_autoload_register(function($class){

  // Verificamos si utiliza namespace buscando \ con strpos()
  if(strpos($class, '\\')){
    // Si lo encuentra es porque tiene un namespace 
    // Creamos un array $clases con las parte del namespace
    $clases = explode('\\', $class);
    // Creamos la variable $rutaDeArchivo para guardar el string con la ruta de archivo
    $rutaDeArchivo = "";
    // Creamos el bucle for para recorrer $clases e ir creando la ruta
    for($i = 0; $i < count($clases); $i++){
      // Para que no coloque una barra separadora / al principio del string condicionamos con if para
      // decir que si $i es distinto de 0 que ponga barra de lo contrario no.
      if($i != 0){
        $rutaDeArchivo = $rutaDeArchivo . SP .$clases[$i];
      }else{
        $rutaDeArchivo = $clases[$i];
        
      }
    }
    // En el include agregamos la extencion de archivo
    include  $rutaDeArchivo . '.php';

  }else{
    // Cuando no usa namespace (No recomendado)
    //Revisamos el directorio que contien las clases
    $dir = (scandir($_SERVER['DOCUMENT_ROOT']));
    // Creamos un bucle para recorrer el directorio y cargar en $dir los directorios que contenga
    for($i = 0; $i < count($dir); $i++){
      // Preguntamos $gesto devuelve verdadero o sea existe la ruta formada por app/$dir[$i] 
      // ($dir[$i] contiene los direcctorios recolectados) 
      if ($gestor = opendir($_SERVER['DOCUMENT_ROOT'] . '/' . $dir[$i])) {
        // Creamos un while que mientras $entrada sea distinto de falso (o sea mientras $entrada tenga algo)
        // Ejecutamos el if
        while (false !== ($entrada = readdir($gestor))) {
          //  Si el archivo que buscamos es igual a Entrada hacemos el include
          if($class.'.php' == $entrada) {
            // Linea que hace el include
            include $_SERVER['DOCUMENT_ROOT'] . '/' . $dir[$i] . SP . $entrada;
          }
        }
        // Cierra gestor
        closedir($gestor);
      }
    }
  }
});
