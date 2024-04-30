<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
    }
    
select {
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 5px;
    background-color: #f7f7f7;
    color: #555;
    width: 30%;
}

select:hover {
    border-color: #999;
}

select:focus {
    border-color: #555;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}


select::-ms-expand {
    display: none;
}

select option {
    padding: 10px;
}


select option:hover {
    background-color: #ddd;
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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['client_id'])) {
    $client_id = $_POST['client_id'];

    $sql = "SELECT s.*, p.name AS product_name, c.name AS client_name, e.name AS employee_name
            FROM Sales s
            JOIN Products p ON s.product_id = p.id
            JOIN client c ON s.client_id = c.id
            JOIN slujitel e ON s.slujitel_id = e.id
            WHERE s.client_id = '$client_id'
            ORDER BY s.sale_date";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2>Продажби на клиент с ID: $client_id</h2>";
        echo "<table>";
        echo "<tr><th>Продукт</th><th>Клиент</th><th>Служител</th><th>Дата на продажба</th><th>Цена</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['client_name'] . "</td>";
            echo "<td>" . $row['employee_name'] . "</td>";
            echo "<td>" . $row['sale_date'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Няма налични записи за продажби за избрания клиент.";
    }
}

$sql = "SELECT * FROM client";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $clients = array();
    while($row = $result->fetch_assoc()) {
        $clients[$row["id"]] = $row["name"];
    }
}

$conn->close();
?>
<form method="POST" action="">
    <label for="client">Изберете клиент:</label>
    <select name="client_id" id="client">
        <option value="">Изберете клиент</option>
        <?php
        foreach ($clients as $id => $name) {
            echo "<option value=\"$id\">$name</option>";
        }
        ?>
    </select>
    <button type="submit"class="button">Изпрати</button><br>
    <a href="index.php"class="button">Към начална страница</a>
</form>
</body>
</html>