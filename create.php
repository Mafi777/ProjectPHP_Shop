<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $servername="localhost";
    $username="root";
    $password="123";
    $dbname="mydb";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
     $sql=" CREATE TABLE Products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        group_id INT(6) NOT NULL,
        price FLOAT(10,2) NOT NULL,
        quantity INT(6) NOT NULL,
        FOREIGN KEY (group_id) REFERENCES `Group`(id)
    )";  
     if ($conn->query($sql) === TRUE) {
        echo "Table Products created successfully";
      } else {
        echo "Error creating table: " . $conn->error;
      }
    
      $sql = "CREATE TABLE client (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        phone VARCHAR(20) NOT NULL
      )";
      
      if ($conn->query($sql) === TRUE) {
        echo "Table client created successfully";
      } else {
        echo "Error creating table: " . $conn->error;
      }
      $sql = "CREATE TABLE IF NOT EXISTS Sales (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        product_id INT(6) UNSIGNED NOT NULL,
        client_id INT(6) UNSIGNED NOT NULL,
        slujitel_id INT(6) UNSIGNED NOT NULL,
        sale_date DATE NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (product_id) REFERENCES products(id),
        FOREIGN KEY (client_id) REFERENCES client(id),
        FOREIGN KEY (slujitel_id) REFERENCES slujitel(id)
    )";
     if ($conn->query($sql) === TRUE) {
      echo "Table client created successfully";
     }
    
    if ($conn->query($sql) === TRUE) {
        echo "Tables are created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
  $conn->close();
     
    ?>
</body>
</html>