<?php
	// Open the database connection
$db = new PDO('sqlite:C:\Users\Laptop\OneDrive\Desktop\SQLiteDox');

// Prepare the SQL statement to insert a new schedule item
$stmt = $db->prepare('INSERT INTO schedule (date, start_time, finish_time) VALUES (:date, :start_time, :finish_time)');

// Loop through the dates and insert a new row for each one
while ($currentDate <= $endDate) {
  $startDate = clone $currentDate;
  $finishDate = clone $currentDate;
  $startDate->setTime(9, 0, 0);
  $finishDate->setTime(17, 0, 0);

  // Bind the values to the prepared statement
  $stmt->bindValue(':date', $startDate->format('Y-m-d'));
  $stmt->bindValue(':start_time', $startDate->format('H:i'));
  $stmt->bindValue(':finish_time', $finishDate->format('H:i'));

  // Execute the statement to insert the row
  $stmt->execute();

  $currentDate->add(new DateInterval('P1D'));
}

// Close the database connection
$db = null;

?>
