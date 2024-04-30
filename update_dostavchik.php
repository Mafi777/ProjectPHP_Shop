<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body{
        background:#F0F8FF;
    }
    input[type="text"] {
        padding: 5px;
        border: none;
        border-radius: 3px;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
        margin-bottom: 5px;
        width: 50%;
    }
    input[type="submit"] {
        background-color: #6495ED ;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        margin-bottom: 20px;
    }
    
    input[type="submit"]:hover {
        background-color: #FF6347;
    }
    a.button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #6495ED;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 10px;
    }

    a.button:hover {
        background-color: #FF6347;
    }
    h2 {
        color: #483D8B;
        padding: 10px 15px;
        margin-bottom: 30px;
    }
    </style>    
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $dostavchik_name = $_POST["dostavchik_name"];
    $eik = $_POST["eik"];

    $sql = "UPDATE Dostavchik SET dostavchik_name='$dostavchik_name', eik='$eik' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Данните за доставчика са актуализирани успешно";
    } else {
        echo "Грешка при редактирането на даннните: " . $conn->error;
    }
} else {
    $id = $_GET["id"];

    $sql = "SELECT * FROM Dostavchik WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dostavchik_name = $row["dostavchik_name"];
        $eik = $row["eik"];
    } else {
        echo "Dostavchik not found";
        exit();
    }
}

$conn->close();
?>

<h2>Редактиране на доставчик</h2>
<form method="post" action="">
    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
    <label for="dostavchik_name">Име на доставчика:</label>
    <input type="text" id="dostavchik_name" name="dostavchik_name" value="<?php echo $dostavchik_name; ?>"><br><br>
    <label for="eik">ЕИК:</label>
    <input type="text" id="eik" name="eik" value="<?php echo $eik; ?>"><br><br>
    <input type="submit" value="Запази"><br>
    <a href="index.php"class="button">Към начална страница</a>
</form>
</body>
</html>