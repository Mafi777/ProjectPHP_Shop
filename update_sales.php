
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
        $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
        $product_id = isset($_POST["product_id"]) ? (int)$_POST["product_id"] : 1;
        $client_id = isset($_POST["client_id"]) ? (int)$_POST["client_id"] : 1;
        $employee_id = isset($_POST["slujitel_id"]) ? (int)$_POST["slujitel_id"] : 1;
        $date = $_POST["sale_date"];
        $price = $_POST["price"];

        if ($id <= 0 || $product_id <= 0 || $client_id <= 0 || $employee_id <= 0) {
            die("Invalid input");
        }

        $sql = "UPDATE sales 
                SET product_id = '$product_id', 
                    client_id = '$client_id', 
                    slujitel_id = '$employee_id', 
                    sale_date = '$date', 
                    price = '$price' 
                WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Данните за продажбата са актуализирани успешно";
        } else {
            echo "Грешка при редактирането на данните: " . $conn->error;
        }
    }

    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

    if ($id <= 0) {
        die("Invalid ID");
    }

    $sql = "SELECT * FROM sales WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        die("Sale not found");
    }

    $sale = $result->fetch_assoc();

    $product_sql = "SELECT * FROM products";
    $product_result = $conn->query($product_sql);

    $client_sql = "SELECT * FROM client";
    $client_result = $conn->query($client_sql);

    $employee_sql = "SELECT * FROM slujitel";
    $employee_result = $conn->query($employee_sql);

    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Редактиране на продажба</title>
</head>
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
<body>
    <h2>Редактиране на продажба</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $sale['id']; ?>">
        <label for="product_id">Продукт:</label>
        <select id="product_id" name="product_id">
            <?php while($row = $product_result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($sale['product_id'] == $row['id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="client_id">Клиент:</label>
        <select id="client_id" name="client_id">
            <?php while($row = $client_result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($sale['client_id'] == $row['id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="slujitel_id">Служител:</label>
        <select id="slujitel_id" name="slujitel_id">
            <?php while($row = $employee_result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($sale['slujitel_id'] == $row['id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="sale_date">Дата:</label>
        <input type="date" id="sale_date" name="sale_date" value="<?php echo $sale['sale_date']; ?>"><br><br>
        <label for="price">Цена:</label>
        <input type="number" id="price" name="price" value="<?php echo $sale['price']; ?>"><br><br>
        <input type="submit" value="Запази"><br>
        <a href="index.php" class="button">Към начална страница</a>
    </form>
</body>
</html>
