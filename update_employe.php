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
    $ime = $_POST["ime"];
    $poziciq = $_POST["poziciq"];
    $telefon = $_POST["telefon"];

    $sql = "UPDATE slujitel SET name='$ime', position='$poziciq', phone='$telefon' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Данните за служителя са обновени успешно";
    } else {
        echo "Грешка при редактирането на данните: " . $conn->error;
    }
}

$id = $_GET["id"];

$sql = "SELECT * FROM slujitel WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ime = $row["name"];
    $poziciq = $row["position"];
    $telefon = $row["phone"];
} else {
    echo "No employee found with ID " . $id;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
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
        padding: 10px 20px;
        margin-bottom: 30px;
    }

select{
    width: 40%;
    height: 40px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding-left: 5px;
    padding: 10px;
    font-size: 18px;
    font-family: 'Open Sans', sans-serif;
    color: #555;
    background-color: rgb(255, 255, 255);
    background-image: none;
    border: 1px solid rgb(41, 18, 18);
}
select>option{
    font-size: 8px;
    font-family: 'Open Sans', sans-serif;
    color: #555;
    background-color: rgb(247, 247, 247);
    background-image: none;
    font-size: 18px;
    height: 50px;
    padding: 15px;
    border: 1px solid rgb(41, 18, 18);
}
    
    </style>
</head>
<body>
    <h2>Редактиране на служител</h2>
    <form method="post" action="">
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
        <label for="ime">Име:</label>
        <input type="text" id="ime" name="ime" value="<?php echo $ime; ?>"><br><br>
        <label for="poziciq">Позиция:</label>
        <input type="text" id="poziciq" name="poziciq" value="<?php echo $poziciq; ?>"><br><br>
        <label for="telefon">Телефон:</label>
        <input type="text" id="telefon" name="telefon" value="<?php echo $telefon; ?>"><br><br>
        <input type="submit" value="Запази"><br>
        <a href="index.php"class="button">Към начална страница</a>
    </form>
</body>
</html>
