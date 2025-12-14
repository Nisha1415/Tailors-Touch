<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailorstouchdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT username, review_text, sentiment FROM feedbacks 
        ORDER BY 
          FIELD(sentiment, 'positive', 'neutral', 'negative'),
          created_at DESC";

$result = $conn->query($sql);

$feedbacks = [];
while ($row = $result->fetch_assoc()) {
  $feedbacks[] = $row;
}

echo json_encode($feedbacks);
$conn->close();
?>
