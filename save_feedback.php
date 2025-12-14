<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailorstouchdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$review = strtolower($conn->real_escape_string($_POST['review']));

// --- Simple Sentiment Analysis ---
$positive_words = ['good', 'great', 'excellent', 'amazing', 'love', 'perfect', 'happy', 'nice', 'awesome', 'satisfied'];
$negative_words = ['bad', 'poor', 'worst', 'hate', 'terrible', 'disappointed', 'awful', 'slow', 'problem', 'dirty'];

$positive_score = 0;
$negative_score = 0;

foreach ($positive_words as $word) {
  if (strpos($review, $word) !== false) $positive_score++;
}
foreach ($negative_words as $word) {
  if (strpos($review, $word) !== false) $negative_score++;
}

if ($positive_score > $negative_score) {
  $sentiment = 'positive';
} elseif ($negative_score > $positive_score) {
  $sentiment = 'negative';
} else {
  $sentiment = 'neutral';
}

// ✅ Insert into DB (no username column)
$sql = "INSERT INTO feedbacks (review_text, sentiment)
        VALUES ('$review', '$sentiment')";

if ($conn->query($sql) === TRUE) {
  echo "Thank you, your feedback has been submitted!";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>
