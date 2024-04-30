<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Dostavki</title>
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
        width: 30%;
        height: 35px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-left: 5px;
        padding: 10px;
        font-size: 13px;
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
    $dostavka_id = $_POST["dostavka_id"];
    $product_id = $_POST["product_id"];
    $group_id = $_POST["group_id"];
    $delivery_price = $_POST["delivery_price"];
    $quantity = $_POST["quantity"];
    $dostavchik_id = $_POST["dostavchik_id"];
    $delivery_date = $_POST["delivery_date"];
    $sql = "UPDATE Dostavki_product SET product_id = '$product_id', group_id = '$group_id', delivery_price = '$delivery_price', quantity = '$quantity', dostavchik_id = '$dostavchik_id', delivery_date = '$delivery_date' WHERE id = $dostavka_id";

    if ($conn->query($sql) === TRUE) {
        echo "Доставката е обновена успешно";
    } else {
        echo "Грешка при обновяването на доставката: " . $conn->error;
    }
}

$dostavka_id = $_GET['id'];
$sql = "SELECT * FROM Dostavki_product WHERE id = $dostavka_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_product_id = $row["product_id"];
    $current_group_id = $row["group_id"];
    $current_delivery_price = $row["delivery_price"];
    $current_quantity = $row["quantity"];
    $current_dostavchik_id = $row["dostavchik_id"];
    $current_delivery_date = $row["delivery_date"];
}

$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[$row["id"]] = $row["name"];
    }
}

$sql = "SELECT * FROM `Group`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $groups = array();
    while ($row = $result->fetch_assoc()) {
        $groups[$row["id"]] = $row["name"];
    }
}

$sql = "SELECT * FROM Dostavchik";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $dostavchiks = array();
    while ($row = $result->fetch_assoc()) {
        $dostavchiks[$row["id"]] = $row["dostavchik_name"];
    }
}

$conn->close();
?>

<h2>Обнови доставка</h2>
<form method="post" action="">
    <input type="hidden" name="dostavka_id" value="<?php echo $dostavka_id; ?>">
    <label for="dostavki_product_id">Продукт:</label>
    <select name="product_id" required>
        <option value="">Изберете продукт</option>
        <?php
        foreach ($products as $id => $name) {
            $selected = ($id == $current_product_id) ? "selected" : "";
            echo "<option value=\"$id\" $selected>$name</option>";
        }
        ?>
    </select><br>
    <label for="group_id">Група:</label>
    <select name="group_id" required>
        <option value="">Изберете група</option>
        <?php
        foreach ($groups as $id => $name) {
            $selected = ($id == $current_group_id) ? "selected" : "";
            echo "<option value=\"$id\" $selected>$name</option>";
        }
        ?>
    </select><br>
    <label for="delivery_price">Доставна цена:</label>
    <input type="text" name="delivery_price" value="<?php echo $current_delivery_price; ?>" required><br>
    <label for="quantity">Брой:</label>
    <input type="text" name="quantity" value="<?php echo $current_quantity; ?>" required><br>
    <label for="dostavchik_id">Доставчик:</label>
    <select name="dostavchik_id" required>
        <?php
        foreach ($dostavchiks as $id => $name) {
            $selected = ($id == $current_dostavchik_id) ? "selected" : "";
            echo "<option value=\"$id\" $selected>$name</option>";
        }
        ?>
    </select><br>
    <label for="delivery_date">Дата на доставка:</label>
    <input type="date" name="delivery_date" value="<?php echo $current_delivery_date; ?>" required><br>
    <input type="submit" value="Обнови"><br>
    <a href="index.php" class="button">Към начална страница</a>
</form>
</body>
</html>
