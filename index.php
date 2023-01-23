<?php
$dsn = 'sqlite:database.db';
$pdo = new PDO($dsn);

$sql = "CREATE TABLE reservations (id INTEGER PRIMARY KEY, name TEXT, email TEXT, date DATE, time TIME, guests INTEGER)";
$pdo->exec($sql);

$name = $_POST["name"];
$email = $_POST["email"];
$date = $_POST["date"];
$time = $_POST["time"];
$guests = $_POST["guests"];

$stmt = $pdo->prepare("INSERT INTO reservations (name, email, date, time, guests) VALUES (?, ?, ?, ?, ?)");
$stmt->bindValue(1, $name);
$stmt->bindValue(2, $email);
$stmt->bindValue(3, $date);
$stmt->bindValue(4, $time);
$stmt->bindValue(5, $guests);
$stmt->execute();

$pdo->query("CREATE INDEX name_index ON reservations(name)");

$stmt = $pdo->query("SELECT * FROM reservations");
$results = $stmt->fetchAll();

$email = $_POST["email"];

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
}

function handleError($e) {
    echo "Error: " . $e->getMessage();
    exit;
}

set_error_handler("handleError");
set_exception_handler("handleError");

$name = $_POST["name"];
$name = strip_tags($name);
$name = htmlspecialchars($name);

$query = "SELECT 1";
$stmt = $pdo->query($query);
if (!$stmt) {
    echo "Error: Could not connect to the database.";
    exit;
}


