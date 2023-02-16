<?php
// Connect to the database using SSL encryption
$db = new mysqli("localhost", "user", "password", "database", 3306, "/path/to/ssl/cert");

// Check if the connection is successful
if ($db->connect_error) {
    die("Error: Failed to connect to database. " . $db->connect_error);
}

// Prepare the query
$stmt = $db->prepare("SELECT * FROM users WHERE name = ?");

// Bind the parameters to prevent SQL injection
$name = "John Doe";
$stmt->bind_param("s", $name);

// Execute the query
$stmt->execute();

// Get the results
$result = $stmt->get_result();

// Validate the input
if ($result->num_rows === 0) {
    die("Error: No results found for the given name.");
}

// Display the results
while ($row = $result->fetch_assoc()) {
    echo htmlspecialchars($row['name'], ENT_QUOTES) . ' (' . htmlspecialchars($row['email'], ENT_QUOTES) . ')<br>';
}

// Close the statement
$stmt->close();

// Close the database connection
$db->close();

// Connect to the MySQL database using XAMPP
$db = mysqli_connect("localhost", "root", "", "staff_roster");

// Check if the connection is successful
if (!$db) {
    die("Error: Failed to connect to the database. " . mysqli_connect_error());
}

// Check if the form is submitted
if (isset($_POST["staff id"])) {
    $staff_id = $_POST["staff_id"];
    $full_name = $_POST["full_name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $position = $_POST["position"];

    // Prepare the query
    $query = "INSERT INTO staff (staff_id, full_name, address, phone, email, position)
              VALUES ('$staff_id', '$full_name', '$address', '$phone', '$email', '$position')";

    // Execute the query
    $result = mysqli_query($db, $query);

    // Check if the insertion is successful
    if ($result) {
        echo "New staff member added successfully.";
    } else {
        echo "Error: Failed to add the new staff member. " . mysqli_error($db);
    }
}
// Close the database connection
mysqli_close($db);

// connect to the database
$db = new PDO('sqlite:restaurant_reservations.db');

// create a table for the reservations
$db->exec('CREATE TABLE IF NOT EXISTS reservations (
           id INTEGER PRIMARY KEY,
           name TEXT NOT NULL,
           email TEXT NOT NULL,
           phone TEXT NOT NULL,
           guests INTEGER NOT NULL,
           notes TEXT
         )');

// function to input a new reservation
function add_reservation($name, $email, $phone, $guests, $notes) {
  global $db;
  $stmt = $db->prepare('INSERT INTO reservations (name, email, phone, guests, notes) VALUES (?, ?, ?, ?, ?)');
  $stmt->execute(array($name, $email, $phone, $guests, $notes));
  echo "Reservation added successfully\n";
}

// function to update an existing reservation
function update_reservation($id, $name=null, $email=null, $phone=null, $guests=null, $notes=null) {
  global $db;
  $update_fields = array();
  if ($name !== null) {
    $update_fields[] = 'name = ?';
  }
  if ($email !== null) {
    $update_fields[] = 'email = ?';
  }
  if ($phone !== null) {
    $update_fields[] = 'phone = ?';
  }
  if ($guests !== null) {
    $update_fields[] = 'guests = ?';
  }
  if ($notes !== null) {
    $update_fields[] = 'notes = ?';
  }

  if (empty($update_fields)) {
    echo "No fields to update\n";
    return;
  }

  $update_query = 'UPDATE reservations SET ' . implode(', ', $update_fields) . ' WHERE id = ?';
  $stmt = $db->prepare($update_query);
  $params = array_filter(array($name, $email, $phone, $guests, $notes));
  $params[] = $id;
  $stmt->execute($params);
  echo "Reservation updated successfully\n";
}

// function to delete a reservation
function delete_reservation($id) {
  global $db;
  $stmt = $db->prepare('DELETE FROM reservations WHERE id = ?');
  $stmt->execute(array($id));
  echo "Reservation deleted successfully\n";
}

// function to display all reservations
function display_reservations() {
  global $db;
  $stmt = $db->query('SELECT * FROM reservations');
  foreach ($stmt as $row) {
    echo "ID: {$row['id']}, Name: {$row['name']}, Email: {$row['email']}, Phone: {$row['phone']}, Guests: {$row['guests']}, Notes: {$row['notes']}\n";
  }
}

// example usage
add_reservation('John Doe', 'john@example.com', '555-1234', 4, 'High chair needed');
display_reservations();
update_reservation(1, 'Jane Smith', null, null, 6, null);
display_reservations();
delete_reservation(1);
display_reservations();

// close the connection
$db = null;
?>