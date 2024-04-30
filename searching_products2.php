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
    $search_text = $_POST["search_text"];
    $search_price_min = $_POST["search_price_min"];
    $search_price_max = $_POST["search_price_max"];
    $search_category = $_POST["group_name"];

    $sql = "SELECT * FROM products WHERE name LIKE '%$search_text%'";

    if ($search_price_min != "") {
        $sql .= " AND price >= $search_price_min";
    }

    if ($search_price_max != "") {
        $sql .= " AND price <= $search_price_max";
    }

    if ($search_category != "") {
        $sql .= " AND group_name = '$search_category'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      
        echo "<table><table border=2><tr><th>Име</th><th>Цена</th><th>Група</th></tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"]. "</td><td>" . $row["price"]. "</td><td>" . $row["group_name"]. "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }
}

$category_sql = "SELECT DISTINCT group_name FROM products";
$category_result = $conn->query($category_sql);

$conn->close();
?>

<h2>Търсене на продукти</h2>
<form method="post" action="">
    <label for="search_text">Търсене по име:</label>
    <input type="text" id="search_text" name="search_text"><br><br>
    <label for="search_price_min">Търсене по минимална цена:</label>
    <input type="number" id="search_price_min" name="search_price_min"><br><br>
    <label for="search_price_max">Търсене по максимална цена:</label>
    <input type="number" id="search_price_max" name="search_price_max"><br><br>
    <label for="search_category">Търсене по категория:</label>
    <select id="group_name" name="group_name">
        <option value="">Избери категория</option>
        <?php while($row = $category_result->fetch_assoc()) { ?>
            <option value="<?php echo $row['group_name']; ?>"><?php echo $row['group_name']; ?></option>
        <?php } ?>
    </select><br><br>
    <input type="submit" value="Търси"><br>
    <a href="index.php" class="button">Към начална страница</a>
</form>
</body>
</html>