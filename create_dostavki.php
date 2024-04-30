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
$sql = "CREATE TABLE IF NOT EXISTS Dostavki_Product (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT(6) UNSIGNED NOT NULL,
    group_id INT(6) UNSIGNED NOT NULL,
    delivery_price FLOAT(10,2) NOT NULL,
    quantity INT(6) NOT NULL,
    delivery_date DATE NOT NULL,
    dostavchik_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (product_id) REFERENCES Products(id),
    FOREIGN KEY (group_id) REFERENCES `Group`(id),
    FOREIGN KEY (dostavchik_id) REFERENCES Dostavchik(id)
)";
$sql = "ALTER TABLE Dostavki_Product ADD COLUMN delivery_date DATE NOT NULL AFTER quantity";

if ($conn->query($sql) === TRUE) {
    echo "Таблицата Dostavki_Product е създадена успешно.";
} else {
    echo "Грешка при създаването на таблицата Dostavki_Product: " . $conn->error;
}
$conn->close();
?>
</body>
</html>