<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailorstouchdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get latest order_id
$query = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $order_id = $row['order_id'];
} else {
    die("Error: No orders found.");
}

// Get measurement values
if (!isset($_POST['measurements']) || empty($_POST['measurements'])) {
    die("Error: Measurement data is missing.");
}

$data = $_POST['measurements'];

// Assigning with default NULL
$waist = isset($data['Waist']) ? floatval($data['Waist']) : NULL;
$bust = isset($data['Bust']) ? floatval($data['Bust']) : NULL;
$chest = isset($data['Chest']) ? floatval($data['Chest']) : NULL;
$hip = isset($data['Hip']) ? floatval($data['Hip']) : NULL;
$shoulder = isset($data['Shoulder']) ? floatval($data['Shoulder']) : NULL;
$blouse_length = isset($data['Blouse Length']) ? floatval($data['Blouse Length']) : NULL;
$sleeve_fit = isset($data['Sleeve fit']) ? floatval($data['Sleeve fit']) : NULL;
$sleeve_length = isset($data['Sleeve Length']) ? floatval($data['Sleeve Length']) : NULL;
$front_deep = isset($data['Front deep']) ? floatval($data['Front deep']) : NULL;
$back_deep = isset($data['Back deep']) ? floatval($data['Back deep']) : NULL;
$up_tucks = isset($data['Up Tucks']) ? floatval($data['Up Tucks']) : NULL;
$down_tucks = isset($data['Down Tucks']) ? floatval($data['Down Tucks']) : NULL;
$armhole = isset($data['Armhole']) ? floatval($data['Armhole']) : NULL;
$flayer = isset($data['Flayer']) ? floatval($data['Flayer']) : NULL;
$pant_length = isset($data['Pant Length']) ? floatval($data['Pant Length']) : NULL;
$kurtha_length = isset($data['Kurtha Length']) ? floatval($data['Kurtha Length']) : NULL;
$gown_length = isset($data['Gown Length']) ? floatval($data['Gown Length']) : NULL;
$frock_length = isset($data['Frock Length']) ? floatval($data['Frock Length']) : NULL;
$hip_length_slit = isset($data['Hip Length(Slit)']) ? floatval($data['Hip Length(Slit)']) : NULL;

$sql = "INSERT INTO measurements (
    order_id, waist, bust, chest, hip, shoulder, blouse_length, sleeve_fit, sleeve_length,
    front_deep, back_deep, up_tucks, down_tucks, armhole, flayer, pant_length,
    kurtha_length, gown_length, frock_length, hip_length_slit
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

// Bind parameters
$stmt->bind_param(
    "iddddddddddddddddddd",
    $order_id, $waist, $bust, $chest, $hip, $shoulder, $blouse_length, $sleeve_fit, $sleeve_length,
    $front_deep, $back_deep, $up_tucks, $down_tucks, $armhole, $flayer, $pant_length,
    $kurtha_length, $gown_length, $frock_length, $hip_length_slit
);

if ($stmt->execute()) {
    echo "<script>
        alert('Measurements submitted successfully!');
        window.location.href = 'trendsnext.php';
    </script>";
} else {
    echo "<script>
        alert('Failed to submit: " . $stmt->error . "');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>
