<?php
$nombre=$_POST['nombre'];
$password=$_POST['password'];
$email=$_POST['email'];
$telefono=$_POST['telefono'];
$genero=$_POST['genero'];
$estado= $_POST['estado'];

if(!empty($nombre) || !empty($password) || !empty($email) || !empty($telefono) || !empty($genero) || !empty(estado)){
    
    $host = "bsotvem4zn1goq3fsfwx-mysql.services.clever-cloud.com";
    $dbusername = "umqpy8ga0jttp3xf";
    $dbpassword = "QC8amvH77WKPDEaT4Aw0";
    $dbname = "bsotvem4zn1goq3fsfwx";


    $conn = new mysqli($host,$dbusername, $dbpassword, $dbname);

    
    if (mysqli_connect_error()){
        die('connect error('.mysqli_connect_error().')'.mysqli_connect_error());
    }
    
    else{
        $SELECT = "SELECT telefono from usuario where telefono = ? limit 1";
        $INSERT = "INSERT INTO usuario (nombre, password, email, telefono, genero, estado) values(?,?,?,?,?,?)";

        
        $stmt = $conn->prepare($SELECT);
        $stmt ->bind_param("i", $telefono);
        $stmt ->execute();
        $stmt -> bind_result($telefono);
        $stmt -> store_result();
        
        $rnum = $stmt->num_rows;
        if ($rnum == 0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt ->bind_param("sssssi", $nombre,$password, $email, $telefono, $genero, $estado);
            $stmt ->execute();
            echo "REGISTRO COMPLETADO.";
        }
        else {
            echo "El numero ya se encuentra registrado.";
        }
        $stmt->close();
        $conn->close();
    }

}
else{
    echo "Todos los datos son obligatorios";
    die(); 
}
?>
