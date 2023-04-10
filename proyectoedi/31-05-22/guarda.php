<?php
    $conexion = include('Config/conexion.php');
    
    
    
 

$file = $_FILES["archivos"]["name"]; //Nombre de nuestro archivo




var_dump($_FILES["archivos"]);
$validator = 1; //Variable validadora

$file_type = strtolower(pathinfo($file,PATHINFO_EXTENSION)); //Extensión de nuestro archivo

$url_temp = $_FILES["archivos"]["tmp_name"]; //Ruta temporal a donde se carga el archivo 

//dirname(__FILE__) nos otorga la ruta absoluta hasta el archivo en ejecución
$url_insert = dirname(__FILE__) . "/files"; //Carpeta donde subiremos nuestros archivos

//Ruta donde se guardara el archivo, usamos str_replace para reemplazar los "\" por "/"
$newNameUniq = uniqid();
$newName = $newNameUniq . '.' . $file_type;
$url_target = str_replace('\\', '/', $url_insert) . '/' . $newName;

//Si la carpeta no existe, la creamos
if (!file_exists($url_insert)) {
    mkdir($url_insert, 0777, true);
};

//Validamos el tamaño del archivo
$file_size = $_FILES["archivos"]["size"];
if ( $file_size > 1000000) {
  echo "El archivo es muy pesado";
  $validator = 0;
}

//Validamos la extensión del archivo
/*if($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png" && $file_type != "gif" ) {
  echo "Solo se permiten imágenes tipo JPG, JPEG, PNG & GIF";
  $validator = 0;
}*/
/*baseGuardar($newName);*/
//movemos el archivo de la carpeta temporal a la carpeta objetivo y verificamos si fue exitoso
$listLineas = array(); 
if($validator == 1){
    if (move_uploaded_file($url_temp, $url_target)) {
        echo "El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.";
        var_dump($url_temp);  
        var_dump('<br>');  
        var_dump($url_target);  
        
        $archivoFopen = fopen( $url_target, "r" );
        if( $archivoFopen == false ) {
            echo ( "Error in opening file" );
            exit();
         }
         $numlinea = 0;
           
         while ($linea = fgets($archivoFopen)) {
            
            $nombre = before ('*', $linea);
            $descripcion = after ('*', $linea);
            echo $numlinea.'<br/>';
            echo $nombre.'<br/>';
            echo $descripcion.'<br/>';
            
            $arraytest= array ('orden'=>$numlinea,'nombre' => $nombre, 'descripcion'=>$descripcion);
           
            array_push($listLineas, $arraytest);
            $numlinea++;
        }
        

    } else {
        echo "Ha habido un error al cargar tu archivo.";
    }
}else{
    echo "Error: el archivo no se ha cargado";
}



        $last_id= null;
    $query="INSERT INTO `archivos`(nombrearchivo, tipoarchivo) VALUES('$newNameUniq','$file_type')";
    $resultado = $conexion->query($query);
    if ($resultado=== TRUE) {
        $last_id = $conexion->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id;
      } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
      }
   // //
    

    
    
    
   



    if($resultado){
        echo"insercion exitosa";
        foreach ($listLineas as &$valor) {
            $numlinea = $valor['orden'];
            $nombre = $valor['nombre'];
            $descripcion = $valor['descripcion'];
            var_dump('<br><br><br>');
            $query2="INSERT INTO `archivosact`(idArchivo, nombre, descripcion, orden) VALUES('$last_id','$nombre','$descripcion', $numlinea)";
            $resultado = $conexion->query($query2);
        }

        

    }else{
        echo"insercion no exitosa";  
    }

    
    function after ($th, $inthat)
    {
        if (!is_bool(strpos($inthat, $th)))
        return substr($inthat, strpos($inthat,$th)+strlen($th));
    };

    function before ($th, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $th));
    };