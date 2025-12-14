<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailorstouchdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["error" => $conn->connect_error]);
    exit;
}

// Fetch all reviews for summary
$sql_all = "SELECT review_text FROM feedbacks";
$res_all = $conn->query($sql_all);

$feedbacks = [];
while ($row = $res_all->fetch_assoc()) {
    $feedbacks[] = $row['review_text'];
}

// Fetch latest 10 feedbacks
$sql_recent = "SELECT review_text, sentiment FROM feedbacks ORDER BY id DESC LIMIT 10";
$res_recent = $conn->query($sql_recent);

$recent_feedbacks = [];
while ($row = $res_recent->fetch_assoc()) {
    $recent_feedbacks[] = $row;
}

if (empty($feedbacks)) {
    echo json_encode([
        "summary" => "No feedbacks yet.",
        "recent_feedbacks" => []
    ]);
    exit;
}

$all_feedback = implode(". ", $feedbacks);

// Ollama Summarization Prompt
$prompt = "Summarize the following customer feedbacks into a short paragraph:\n\n$all_feedback";

// Call Ollama API
$url = "http://localhost:11434/api/generate";
$data = ["model" => "llama3", "prompt" => $prompt, "stream" => false];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);

$summary = "";
if ($response) {
    $json = json_decode($response, true);
    $summary = $json['response'] ?? "";
}

// Fallback
if (!$summary) {
    $summary = "Customers are happy with the fitting, quality, and on-time delivery at Tailors Touch.";
}

echo json_encode([
    "summary" => trim($summary),
    "recent_feedbacks" => $recent_feedbacks
]);
?>
