<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "tailorstouchdb"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if trend is passed
if (isset($_GET['trend'])) {
    $trend = $_GET['trend'];

    // Define measurement fields for each trend
    $measurements = [
        "Blouse" => ["Bust", "Chest", "Waist", "Shoulder", "Blouse Length", "Sleeve fit", "Sleeve Length", "Front deep", "Back deep", "Up Tucks", "Down Tucks", "Armhole"],
        "Salwar" => ["Waist", "Chest", "Hip", "Top Length", "Hip Length(Slit)", "Shoulder", "Front deep", "Back deep", "Sleeve fit", "Sleeve Length", "Armhole", "Flayer", "Pant Length"],
        "Kurtha" => ["Waist", "Chest", "Shoulder", "Kurtha Length", "Hip", "Hip Length(Slit)", "Front deep", "Back deep", "Sleeve fit", "Sleeve Length", "Armhole", "Flayer"],
        "Gown" => ["Waist", "Bust", "Chest", "Hip", "Shoulder", "Front deep", "Back deep", "Sleeve fit", "Sleeve Length", "Armhole", "Gown Length"],
        "Skirt"=>["Hip","Skirt Length"],
        "Frock" => ["Waist", "Chest", "Hip", "Bust", "Shoulder", "Sleeve fit", "Sleeve Length", "Armhole", "Frock Length"]
    ];

    if (!array_key_exists($trend, $measurements)) {
        die("Invalid trend selected.");
    }
} else {
    die("Trend is missing.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Measurement Entry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            text-align: center;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 30%;
            margin: auto;
            text-align: left;
        }
        h2 {
            text-align: center;
            color: #2e7d32;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .input-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            flex: 1;
        }
        input {
            flex: 2;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #4CAF50;
        }
        .tryon-btn {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
        }
        .tryon-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter Measurements for <?php echo htmlspecialchars($trend); ?></h2>
        <form action="save_measurement.php" method="POST">
            <input type="hidden" name="trend" value="<?php echo htmlspecialchars($trend); ?>">
            
            <?php foreach ($measurements[$trend] as $measurement) : ?>
                <div class="input-group">
                    <label><?php echo htmlspecialchars($measurement); ?>:</label>
                    <input type="text" name="measurements[<?php echo htmlspecialchars($measurement); ?>]" required>
                </div>
            <?php endforeach; ?>
    
            <button type="submit">Submit</button>
        </form>
        
    
    </div>
</body>
</html>
