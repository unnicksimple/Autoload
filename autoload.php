<?php
// Esta autocarga o autoload sirve solo si utilizamos namespace en nuestras clases.
// En esta version obligatoriamente el namespace es el directorio donde se aloja
// Recuerda tu clase SIEMPRE debe llamarse al igual que el archivo php 
// Ej: Prueba.class.php ----- class Prueba{} 
// Ejemplo de namespace: namespace directorio\subdirectorio

spl_autoload_register(function($clase){

// Verificamos si contiene namespace
// strpos — Encuentra la posición de la primera ocurrencia de un substring en un string
    if(strpos($clase, '\\')){
// Si los encuentra es porque utiliza namespace
// La idea es crear toda la ruta para poder cargar la clase
// Para esto creamos un arreglo (array) con las partes del namespace

      $partesNameSpace = explode('\\', $clase);

// recorremos $rutaClases y armamos la ruta
      $rutaDeClase = "";
      for ($i=0; $i < count($partesNameSpace); $i++) { 
        if ( $i != 0 ) {

          $rutaDeClase = $rutaDeClase . '/' . $partesNameSpace[$i];

        } else {

          $rutaDeClase = $partesNameSpace[$i];

        }
      }
      
       include $rutaDeClase . '.php';

    } else {

      echo "Debes incluir namespaces en tu código";

    }
  }
);
