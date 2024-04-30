<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE slujitel (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    position VARCHAR(30) NOT NULL,
    phone VARCHAR(15) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table slujitel created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>

</body>
</html>