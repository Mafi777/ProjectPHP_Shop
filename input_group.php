<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добави нова група</title>
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
        $group_name = $_POST["name"];

        $sql = "INSERT INTO `Group` (name) VALUES ('$group_name')";


        if ($conn->query($sql) === TRUE) {
            echo "Групата е добавена успешно";
        } else {
            echo "Грешка при добавянето на групата: " . $conn->error;
        }
    }
    
    $conn->close();
    ?>

    <h2>Добави нова група</h2>
    <form method="post" action="">
        <label for="name">Име на група:</label>
        <input type="text" id="name" name="name"><br><br>
        <input type="submit" value="Запази"><br>
        <a href="index.php" class="button">Към начална страница</a>
    </form>
</body>
</html>
