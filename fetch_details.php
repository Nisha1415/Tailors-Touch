<?php
include 'db.php';

if (isset($_POST['type']) && isset($_POST['order_id'])) {
    $type = $_POST['type'];
    $order_id = intval($_POST['order_id']);

    if ($type === 'measurement') {
        $res = mysqli_query($conn, "SELECT * FROM measurements WHERE order_id = $order_id");
        if ($row = mysqli_fetch_assoc($res)) {
            echo "<h5>Measurement Details</h5><ul>";
            foreach ($row as $key => $value) {
                echo "<li><strong>$key:</strong> $value</li>";
            }
            echo "</ul>";
        } else {
            echo "No measurement data found.";
        }
    }

    if ($type === 'homevisit') {
        // First get user_id from order_id
        $order_query = mysqli_query($conn, "SELECT user_id FROM orders WHERE order_id = $order_id");
        if ($order = mysqli_fetch_assoc($order_query)) {
            $user_id = $order['user_id'];

            // Now fetch home visit by user_id
            $res = mysqli_query($conn, "SELECT * FROM homevisits WHERE user_id = $user_id ORDER BY visit_id DESC LIMIT 1");
            if ($row = mysqli_fetch_assoc($res)) {
                echo "<h5>Home Visit Details</h5><ul>";
                foreach ($row as $key => $value) {
                    echo "<li><strong>$key:</strong> $value</li>";
                }
                echo "</ul>";
            } else {
                echo "No home visit data found for this user.";
            }
        } else {
            echo "Invalid order ID.";
        }
    }
}

?>
