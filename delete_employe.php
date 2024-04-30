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

    $sql = "DELETE FROM slujitel WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $_GET["id"]);

    if ($stmt->execute() === TRUE) {
        echo "Служителят е изтрит успешно";
    } else {
        echo "Грешка при изтриването на реда: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Не е предоставено ID за изтриване";
}
?>

</body>
</html>