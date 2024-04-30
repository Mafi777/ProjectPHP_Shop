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
  $dostavchik_name = $_POST["dostavchik_name"];
  $eik = $_POST["eik"];

  $sql = "INSERT INTO Dostavchik (dostavchik_name, eik) VALUES ('$dostavchik_name', '$eik')";

  if ($conn->query($sql) === TRUE) {
    echo "Данните са добавени успешно";
  } else {
    echo "Грешка: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dostavchik</title>
</head>
<body>
  <h2>Добави доставчик</h2>
  <form method="POST">
    <label for="dostavchik_name">Име на доставчик:</label>
    <input type="text" name="dostavchik_name"><br><br>
    <label for="eik">ЕИК:</label>
    <input type="text" name="eik"><br><br>
    <input type="submit" value="Добави">
    <br>
    <a href="index.php" class="button">Към начална страница</a>
  </form>
</body>
</html>