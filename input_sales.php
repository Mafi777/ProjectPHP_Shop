<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale</title>
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
        $product_ids = isset($_POST["product_id"]) ? $_POST["product_id"] : [];
        $client_id = isset($_POST["client_id"]) ? (int)$_POST["client_id"] : 1;
        $employee_id = isset($_POST["slujitel_id"]) ? (int)$_POST["slujitel_id"] : 1;
        $date = $_POST["sale_date"];
        $price = $_POST["price"];
    
        if (empty($product_ids) || $client_id <= 0 || $employee_id <= 0) {
            die("Моля, попълнете всички полета");
        }
    
        foreach ($product_ids as $product_id) {
            $sql = "INSERT INTO sales (product_id, client_id, slujitel_id, sale_date, price) 
                    VALUES ('$product_id', '$client_id', '$employee_id', '$date', '$price')";
                    
            if ($conn->query($sql) === TRUE) {
                echo "Продажбата на продукт с ID $product_id е добавена успешно<br>";
            } else {
                echo "Грешка при добавяне на продажба за продукт с ID $product_id: " . $conn->error . "<br>";
            }
        }
    
        if ($conn->query($sql) === TRUE) {
            echo "Продажбата е добавена успешно";
        } else {
            echo "Грешка: " . $sql . "<br>" . $conn->error;
        }
    }
    
    $product_sql = "SELECT * FROM products";
    $product_result = $conn->query($product_sql);

    $client_sql = "SELECT * FROM client";
    $client_result = $conn->query($client_sql);

    $employee_sql = "SELECT * FROM slujitel";
    $employee_result = $conn->query($employee_sql);

    $conn->close();
    ?>

    <h2>Добавяне на продажба</h2>
    <form method="post" action="">
    <label for="product_id[]">Продукт:</label>
    <select id="product_id[]" name="product_id[]" multiple="multiple">
    <?php while($row = $product_result->fetch_assoc()) { ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
    <?php 
    }
    ?>
</select><br><br>
        <label for="client_id">Клиент:</label>
        <select id="client_id" name="client_id">
            <?php while($row = $client_result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php
         }
          ?>
        </select><br><br>
        <label for="slujitel_id">Служител:</label>
        <select id="slujitel_id" name="slujitel_id">
            <?php while($row = $employee_result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php 
        } 
        ?>
        </select><br><br>
        <label for="sale_date">Дата:</label>
        <input type="date" id="date" name="sale_date"><br><br>
        <label for="price">Цена:</label>
        <input type="number" id="price" name="price"><br><br>
        <input type="submit" value="запази"><br>
        <a href="index.php"class="button">Към начална страница</a>
    </form>
</body>
</html>
