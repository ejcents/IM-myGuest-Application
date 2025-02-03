<?php

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "sample";

$conn = new mysqli(hostname: $db_server, username: $db_user, password: $db_password, database: $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableSql = "CREATE TABLE IF NOT EXISTS MyGuests (
    id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

if ($conn->query(query: $tableSql) === TRUE) {
    // Table created successfully
} else {
    die("Error creating table: " . $conn->error);
}

$checkData = "SELECT COUNT(*) AS total FROM MyGuests";
$result = $conn->query(query: $checkData);
$row = $result->fetch_assoc();

if ($row['total'] == 0) {
    $insertSql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES
    ('GC Evo', 'Castanares', 'gcevo@gmail.com'),
    ('Ivan Yuichi', 'Cervantes', 'ivanyuichi@gmail.com'),
    ('Jeric', 'Polison', 'polison@gmail.com'),";

    if ($conn->query(query: $insertSql) === TRUE) {
        // Data inserted successfully
    } else {
        die("Error inserting data: " . $conn->error);
    }
}

function fetchGuests($conn): mixed {
    $sql = "SELECT id, firstname, lastname, email, reg_date FROM MyGuests";
    return $conn->query($sql);
}
function addGuests($conn,$firstname,$lastname,$email) {
    $stmt = $conn->prepare("INSERT INTO MyGuests(firstname,lastname,email) VALUES(?,?,?)");
    $stmt->bind_param("sss" , $firstname, $lastname, $email);
    return $stmt->execute();
}
?>