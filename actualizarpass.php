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

// Consulta SQL para obtener todas las contraseñas existentes
$sql = "SELECT id, password FROM administradores";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Actualizar cada contraseña codificándola con Bcrypt
    while ($row = mysqli_fetch_assoc($result)) {
        $hashedPassword = password_hash($row['password'], PASSWORD_BCRYPT);
        $updateSql = "UPDATE administradores SET password = '" . $hashedPassword . "' WHERE id = " . $row['id'];
        if (mysqli_query($conn, $updateSql)) {
            echo "Contraseña actualizada correctamente para el ID " . $row['id'] . "<br>";
        } else {
            echo "Error al actualizar la contraseña para el ID " . $row['id'] . ": " . mysqli_error($conn) . "<br>";
        }
    }
} else {
    echo "No se encontraron contraseñas en la tabla 'administradores'.";
}

// Cerrar la conexión
mysqli_close($conn);
