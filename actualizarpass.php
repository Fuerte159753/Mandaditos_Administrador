<?php

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // No hay contraseña en XAMPP por defecto
$database = "pedidos";

// Conexión a la base de datos
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Agregar un nuevo administrador con la contraseña sin encriptar
$insertSql = "INSERT INTO administradores (name, last_name, mother_last_name, phone, username, email, password) 
              VALUES ('Alejandro Javier', 'Mayor', 'Martinez', '7721383124', 'alejavi569', 'alejavi569@gmail.com', '123456789')";

if (mysqli_query($conn, $insertSql)) {
    echo "Nuevo administrador agregado correctamente.<br>";
    
    // Obtener el ID del nuevo administrador insertado
    $newAdminId = mysqli_insert_id($conn);
    
    // Consultar la contraseña sin encriptar
    $sql = "SELECT password FROM administradores WHERE id = $newAdminId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $password = $row['password'];
    
    // Encriptar la contraseña
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // Actualizar la contraseña encriptada en la base de datos
    $updateSql = "UPDATE administradores SET password = '$hashedPassword' WHERE id = $newAdminId";
    if (mysqli_query($conn, $updateSql)) {
        echo "Contraseña encriptada correctamente para el nuevo administrador.<br>";
    } else {
        echo "Error al encriptar la contraseña: " . mysqli_error($conn) . "<br>";
    }
    
} else {
    echo "Error al agregar el nuevo administrador: " . mysqli_error($conn) . "<br>";
}

// Cerrar la conexión
mysqli_close($conn);
?>