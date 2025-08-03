<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$dbname = "tailorstouchdb";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
  die("Please login to continue.");
}

$user_id = $_SESSION['user_id'];
$address = "Not Available";

$sql = "SELECT address FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($fetchedAddress);
if ($stmt->fetch()) {
    $address = $fetchedAddress;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Schedule a Home Visit</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 20px;
      max-width: 600px;
      margin: auto;
    }
    h2 {
      text-align: center;
    }
    select, textarea, button {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    button {
      background-color: #4CAF50;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    .address-section {
      background: white;
      padding: 15px;
      border-radius: 6px;
      box-shadow: 0 0 5px #ccc;
      margin-top: 20px;
    }
    .address-display {
      background: #f9f9f9;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .radio-options label {
      display: block;
      margin-bottom: 10px;
    }
    .delivery-address {
      display: none;
    }
    #gps-btn {
      background-color: #2196F3;
      margin-top: 10px;
    }
    #gps-coordinates {
      font-size: 14px;
      color: #333;
    }
  </style>
</head>
<body>

<h2>Schedule a Home Visit</h2>

<form action="save_location.php" method="POST">
  
  <label>Gender:
    <select name="gender" required>
      <option value="">Select Gender</option>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>
  </label>

  <label>Preferred Time:
    <select name="time_slot" required>
      <option value="">Select Time Slot</option>
      <option>Morning (8AM-12PM)</option>
      <option>Afternoon (12PM-4PM)</option>
      <option>Evening (4PM-8PM)</option>
    </select>
  </label>

  <div class="address-section">
    <strong>Delivery Address</strong>
    
    <div class="radio-options">
      <label>
        <input type="radio" name="address_option" value="same" checked>
        Use my default address
      </label>
      <div class="address-display" id="default-address">
        <?php echo htmlspecialchars($address); ?>
      </div>

      <label>
        <input type="radio" name="address_option" value="different">
        Use a different address
      </label>
    </div>

    <div class="delivery-address" id="delivery-address">
      <textarea name="delivery_address" placeholder="Enter full delivery address including area, city and PIN code"></textarea>

      <!-- GPS Section -->
      <button type="button" id="gps-btn">Use My Current Location</button>
      <p id="gps-coordinates"></p>
      <input type="hidden" name="latitude" id="latitude">
      <input type="hidden" name="longitude" id="longitude">
    </div>
  </div>

  <button type="submit">Confirm Visit</button>
</form>

<script>
  // Toggle address textarea
  document.querySelectorAll('input[name="address_option"]').forEach(option => {
    option.addEventListener('change', function () {
      document.getElementById('delivery-address').style.display =
        this.value === 'different' ? 'block' : 'none';
    });
  });

  // GPS button logic
  document.getElementById('gps-btn').addEventListener('click', function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lon;
        document.getElementById('gps-coordinates').innerText = `Latitude: ${lat}, Longitude: ${lon}`;
      }, function (error) {
        alert("Error getting location: " + error.message);
      });
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  });
</script>

</body>
</html>
