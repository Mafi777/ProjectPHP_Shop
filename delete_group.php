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
if(isset($_GET["id"])) {
    
    $servername = "localhost";
    $username = "root";
    $password = "123";
    $dbname = "mydb";
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $id = $_GET["id"];
    $sql = "DELETE FROM `Group` WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        echo "Групата е изтрита успешно";
    } else {
        echo "Грешка при изтриването на групата: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Не е посочен идентификатор за изтриване";
}
?>
</body>
</html>