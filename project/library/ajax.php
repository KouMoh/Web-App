<?php
include 'db_connection.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<div>" . $row["title"]. " - " . $row["author"]. "</div>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
