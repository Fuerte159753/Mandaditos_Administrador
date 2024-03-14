<?php
$servername = "localhost";
$username = "alejandro";
$password = "Aezakmi1?";
$dbname = "pruebita_holi";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    echo "se hizo conexion";
}

$sql = "SELECT*FROM holi";
$result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
    echo $result = $row['id'];
    echo $result = $row['name'];
    }

?>  