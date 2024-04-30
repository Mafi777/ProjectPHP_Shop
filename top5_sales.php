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

$sql = "SELECT p.name AS product_name, SUM(quantity) AS total_quantity
        FROM Sales s
        JOIN Products p ON s.product_id = p.id
        GROUP BY s.product_id
        ORDER BY total_quantity DESC
        LIMIT 5";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<h2>Top 5 класация по продажби на продукти</h2>";
    echo "<table>";
    echo "<tr><th>Продукт</th><th>Общо количество продажби</th></tr>";

  
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['total_quantity'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Няма налични данни за класацията.";
}


$conn->close();
?>
    <a href="index.php"class="button">Към начална страница</a>
</body>
</html>