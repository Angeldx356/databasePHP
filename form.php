<?php
$nombre = $_POST['nombre'];
$password = $_POST['password'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$genero = $_POST['genero'];
$estado = $_POST['estado'];

if (!empty($nombre) && !empty($password) && !empty($email) && !empty($telefono) && !empty($genero) && !empty($estado)) {
    
    $host = "bsotvem4zn1goq3fsfwx-mysql.services.clever-cloud.com";
    $dbusername = "umqpy8ga0jttp3xf";
    $dbpassword = "QC8amvH77WKPDEaT4Aw0";
    $dbname = "bsotvem4zn1goq3fsfwx";

    // Establecer la conexión a la base de datos
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // Verificar la conexión
    if (mysqli_connect_error()) {
        die('Error de conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    } else {
        // Preparar la consulta para verificar si el correo electrónico ya está registrado
        $SELECT = "SELECT email FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            // El correo electrónico no está registrado, se procede con la inserción
            $stmt->close();
            $INSERT = "INSERT INTO usuario (nombre, password, email, telefono, genero, estado) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssss", $nombre, $password, $email, $telefono, $genero, $estado);
            $stmt->execute();
            echo "REGISTRO COMPLETADO.";
        } else {
            // El correo electrónico ya está registrado
            echo "El correo electrónico ya se encuentra registrado.";
        }
        $stmt->close();
        $conn->close();
    }

} else {
    // Si algún campo está vacío, mostrar mensaje de error
    echo "Todos los datos son obligatorios";
}
?>

