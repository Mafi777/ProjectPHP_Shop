<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazin</title>

    <h1>Хранителен Магазин Бени</h1>
    <a href="input_product.php" class="button">Добави продукт</a>
    <a href="input_group.php" class="button">Добави група</a>
    <a href="input_position.php" class="button">Добави позиция</a>
    <a href="input_employe.php" class="button">Добави служител</a>

    <a href="input_client.php" class="button">Добави клиент</a>

    <a href="input_sales.php" class="button">Добави продажба</a>
    <a href="input_dostavchik.php" class="button">Добави доставчик</a>
    <a href="input_dostavki.php" class="button">Добави доставки</a>
    <a href="searching_products2.php" class="button">Търсене на продукт</a>
    <a href="spravka_po_data.php" class="button">Справка по дата</a>
    <a href="spravki_slujitel.php" class="button">Справка по продажби на служител</a>
    <a href="spravki_klient.php" class="button">Справка по продажби на клиент</a>
    <a href="top5_sales.php" class="button">Топ 5 продажби</a>
    <a href="information_selected_date.php" class="button">Информация за доставени продукти на определена дата</a>
    <a href="information_deliveler_by_deliver.php" class="button">Информация за доставки от определен доставчик</a>


    <style>
        body {
            background: linear-gradient(to bottom right, white, skyblue);
            font-family: 'Lobster', cursive;
            min-height: 100vh;
            place-items: center;
        }

        .rotate {
            position: relative;
            font-size: 118px;
            filter: blur(2px) contrast(4);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            background-color: #F0F8FF;

        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 2px solid #ddd;

        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        h1 {
            font-size: 4rem;
            text-align: center;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #000080;
            text-shadow: 1px 1px 1px #957dad,
                1px 2px 1px #957dad,
                1px 3px 1px #957dad,
                1px 4px 1px #957dad,
                1px 5px 1px #957dad,
                1px 6px 1px #957dad,
                1px 10px 5px rgba(16, 16, 16, 0.5),
                1px 15px 10px rgba(16, 16, 16, 0.4),
                1px 20px 30px rgba(16, 16, 16, 0.3),
                1px 25px 50px rgba(16, 16, 16, 0.2);
        }

        h2 {
            font-size: 40px;
            font-weight: 600;
            font-family: 'Niconne', cursive;
            color: #e0d6e9;
            text-shadow: 2px 2px 0px #957dad,
                4px 4px 0px #ee4b2b,
                6px 6px 0px #00c2cb,
                8px 8px 0px #ff7f50,
                10px 10px 0px #553c9a;
        }

        h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        a.button {
            background-color: #4682B4;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }

        a.button:hover {
            background-color: #AFEEEE;
        }
    </style>
    </body>

</html>
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
    $sql = "SELECT * FROM `Group`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Групи</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Име на група</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"] . "</td>";
            echo '<td><a href="delete_group.php?id=' . $row['id'] . '" style="color: #ff0000; text-decoration: none;">Изтрий</a> | <a href="update_group.php?id=' . $row['id'] . '" style="color: #0000ff; text-decoration: none;">Редактирай</a></td>';
            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $sql = "SELECT * FROM Products";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo " <h2> Продукти</h2>";
        echo "<table>";
        echo "<table border=2>";
        echo "<tr><th>Име</th><th>Име на група</th><th>Цена</th><th>Количество</th></tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['group_name'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo '<td><a href="delete_product.php?id=' . $row['id'] . '" style="color: #ff0000; text-decoration: none;">Изтрий</a> | <a href="update_product.php?id=' . $row['id'] . '" style="color: #0000ff; text-decoration: none;">Редактирай</a></td>';
            echo "</td></tr>";

        }
        echo "</table>";
    } else {
        echo "0 results";
    }


    $sql = "SELECT * FROM Position";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Позиции</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Позиций</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"] . "</td>";
            echo '<td><a href="delete_position.php?id=' . $row['id'] . '" style="color: #ff0000; text-decoration: none;">Изтрий</a> | <a href="update_position.php?id=' . $row['id'] . '" style="color: #0000ff; text-decoration: none;">Редактирай</a></td>';
            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $sql = "SELECT * FROM slujitel";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo "<table><table border=2><tr><th>Име</th><th>Позиция</th><th>Телефон</th></tr>";
        echo " <h2> Служител</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["position"] . "</td><td>" . $row["phone"] . "</td>";
            echo '<td><a href="delete_employe.php?id=' . $row['id'] . '" style="color: #ff0000; text-decoration: none;">Изтрий</a> | <a href="update_employe.php?id=' . $row['id'] . '" style="color: #0000ff; text-decoration: none;">Редактирай</a></td>';
            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $sql = "SELECT * FROM client";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><table border=2><tr><th>Име</th><th>Телефон</th></tr>";
        echo " <h2> Клиент</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["phone"] . "</td>";
            echo '<td><a href="delete_client.php?id=' . $row['id'] . '" style="color: #ff0000; text-decoration: none;">Изтрий</a> | <a href="update_client.php?id=' . $row['id'] . '" style="color: #0000ff; text-decoration: none;">Редактирай</a></td>';
            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }


    $sql = "SELECT sales.id, products.name AS product_name, client.name AS client_name, slujitel.name AS slujitel_name, sale_date, sales.price 
        FROM sales 
        INNER JOIN products ON sales.product_id = products.id 
        INNER JOIN client ON sales.client_id = client.id 
        INNER JOIN slujitel ON sales.slujitel_id = slujitel.id";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "<table border=2><tr><th>Продукт</th><th>Клиент</th><th>Служител</th><th>Дата</th><th>Цена</th>";
        echo " <h2>Продажби</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["product_name"] . "</td><td>" . $row["client_name"] . "</td><td>" . $row["slujitel_name"] . "</td><td>" . $row["sale_date"] . "</td><td>" . $row["price"] . "</td>";
            echo '<td><a href="delete_sales.php?id=' . $row['id'] . '" style="color: #ff0000; text-decoration: none;">Изтрий</a></td>';
            echo '<td><a href="update_sales.php?id=' . $row['id'] . '" style="color: #ff000; text-decoration: none;">Редактирай</a></td>';
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $sql = "SELECT * FROM Dostavchik";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Доставчик</h2>";
        echo "<table border='2'>";
        echo "<tr><th>Име на доставчик</th><th>ЕИК</th>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["dostavchik_name"] . "</td>";
            echo "<td>" . $row["eik"] . "</td>";
            echo '<td><a href="delete_dostavchik.php?id=' . $row['id'] . '" style="color: #ff0000; text-decoration: none;">Изтрий</a> | <a href="update_dostavchik.php?id=' . $row['id'] . '" style="color: #0000ff; text-decoration: none;">Редактирай</a></td>';
            echo "</td></tr>";

        }
        echo "</table>";

    } else {
        echo "0 results";
    }

    $sql = "SELECT dostavki_product.id, products.name AS product_name, `Group`.name AS group_name, dostavki_product.delivery_price, dostavki_product.quantity, dostavki_product.delivery_date AS delivery_date, Dostavchik.dostavchik_name AS dostavchik_name
    FROM dostavki_product
    INNER JOIN Products ON dostavki_product.product_id = Products.id
    INNER JOIN `Group` ON dostavki_product.group_id = `Group`.id
    INNER JOIN Dostavchik ON dostavki_product.dostavchik_id = Dostavchik.id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='2'>";
        echo "<h2>Доставки</h2>";
        echo "<tr><th>Продукт</th><th>Група</th><th>Доставна цена</th><th>Брой</th><th>Дата на доставка</th><th>Доставчик</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['group_name'] . "</td>";
            echo "<td>" . $row['delivery_price'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['delivery_date'] . "</td>";
            echo "<td>" . $row['dostavchik_name'] . "</td>";
            echo '<td><a href="delete_dostavki.php?id=' . $row['id'] . '" style="color: #ff0000; text-decoration: none;">Изтрий</a> | <a href="update_dostavki.php?id=' . $row['id'] . '" style="color: #0000ff; text-decoration: none;">Редактирай</a></td>';
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Няма записи за доставки";
    }


    $conn->close();
    ?>
</body>
</html>