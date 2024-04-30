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
    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        background-color: #F0F8FF;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 2px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    input[type="date"] {
        padding: 5px;
        border: none;
        border-radius: 3px;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
        margin-bottom: 5px;
        width: 30%;
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
    }.button {
  background-color: #6495ED; 
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}button:hover {
        background-color: #FF6347;
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

if (isset($_POST['date'])) {
    $date = $_POST['date'];

    $sql = "SELECT dp.id, p.name AS product_name, g.name AS group_name, dp.delivery_price, dp.quantity, dp.delivery_date, d.dostavchik_name AS dostavchik_name
            FROM Dostavki_Product dp
            JOIN Products p ON dp.product_id = p.id
            JOIN `Group` g ON dp.group_id = g.id
            JOIN Dostavchik d ON dp.dostavchik_id = d.id
            WHERE dp.delivery_date = '$date'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Информация за доставени продукти на дата: $date</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Продукт</th><th>Група</th><th>Доставна цена</th><th>Брой</th><th>Дата на доставка</th><th>Доставчик</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['group_name'] . "</td>";
            echo "<td>" . $row['delivery_price'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['delivery_date'] . "</td>";
            echo "<td>" . $row['dostavchik_name'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Няма налични данни за доставки на дата: $date.";
    }
}

$conn->close();
?>
<form method="POST" action="">
    <label for="date">Изберете дата:</label>
    <input type="date" name="date" id="date" required>
    <input type="submit" value="Изпрати"class="button"><br>
    <a href="index.php"class="button">Към начална страница</a>
</form>
</body>
</html>
