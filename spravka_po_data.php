<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Продажби за период</title>
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
    <h2>Продажби за период</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Start date: <input type="date" name="start_date" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>"><br>
        End date: <input type="date" name="end_date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>"><br>
        <input type="submit" value="Изведи Справка">
    </form>
    <a href="index.php" class="button">Към начална страница</a>

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
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];

    $start_date = isset($_POST["start_date"]) ? $_POST["start_date"] : date("Y-m-d", strtotime("-1 month"));
    $end_date = isset($_POST["end_date"]) ? $_POST["end_date"] : date("Y-m-d");
    $sql = "SELECT sales.id, sales.sale_date, sales.price, products.name, client.name AS client_name, slujitel.name AS slujitel_name 
    FROM sales 
    JOIN products ON sales.product_id = products.id 
    JOIN client ON sales.client_id = client.id 
    JOIN slujitel ON sales.slujitel_id = slujitel.id 
    WHERE sales.sale_date BETWEEN '$start_date' AND '$end_date'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Дата на продажба</th><th>Цена</th><th>Име на продукт</th><th>Име на клиент</th><th>Име на служител</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["sale_date"]. "</td><td>" . $row["price"]. "</td><td>" . $row["name"]. "</td><td>" . $row["client_name"]. "</td><td>" . $row["slujitel_name"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Няма намерени продажби в този период";
}

}
?>
</body>
</html>