<?php
include 'db.php';

// Handle AJAX actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete User
    if (isset($_POST['delete_user_id'])) {
        $user_id = intval($_POST['delete_user_id']);
        $query = "DELETE FROM users WHERE user_id = $user_id";
        echo mysqli_query($conn, $query) ? "success" : "error";
        exit();
    }

    // Delete Order
    if (isset($_POST['delete_order_id'])) {
        $order_id = intval($_POST['delete_order_id']);
        $query = "DELETE FROM orders WHERE order_id = $order_id";
        echo mysqli_query($conn, $query) ? "success" : "error";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - Tailors Touch</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f4f6f9;
    }
    .sidebar {
      height: 100vh;
      background-color: #2b3e50;
      color: white;
      padding: 20px 0;
      position: fixed;
      width: 230px;
    }
    .sidebar a {
      display: block;
      color: #ddd;
      padding: 10px 20px;
      text-decoration: none;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #1a252f;
      color: #fff;
    }
    .main-content {
      margin-left: 230px;
      padding: 20px;
    }
    .card-box {
      border-radius: 12px;
      padding: 30px;
      color: #fff;
      margin-bottom: 20px;
    }
    .bg-orange { background-color: #ff9f43; }
    .bg-blue { background-color: #3498db; }
    .bg-green { background-color: #2ecc71; }
    .content-section { display: none; }
    .content-section.active { display: block; }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2 class="text-center">Tailors Touch</h2>
    <a href="#" class="active" data-target="dashboard">Dashboard</a>
    <a href="#" data-target="orders">Orders</a>
    <a href="#" data-target="users">Users</a>
    <a href="#" data-target="useractivity">User Order Details</a>
  </div>

  <div class="main-content">
    <!-- Dashboard -->
    <div id="dashboard" class="content-section active">
      <h3>Dashboard Overview</h3>
      <div class="row">
        <div class="col-md-3"><div class="card-box bg-orange"><h4>Orders</h4></div></div>
        <div class="col-md-3"><div class="card-box bg-blue"><h4>Users</h4></div></div>
        <div class="col-md-3"><div class="card-box bg-green"><h4>Visits</h4></div></div>
      </div>

      <!-- Recent Orders -->
      <div class="card mt-4">
        <div class="card-header bg-dark text-white">Recent Orders</div>
        <div class="card-body">
          <?php
          $recent_orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_id DESC LIMIT 10");
          echo "<table class='table table-bordered table-hover'>
                  <thead class='thead-dark'>
                    <tr>
                      <th>Order ID</th>
                      <th>Category</th>
                      <th>Trend</th>
                      <th>Material</th>
                      <th>Color</th>
                      <th>Date</th>
                    </tr>
                  </thead><tbody>";
          while($row = mysqli_fetch_assoc($recent_orders)) {
            echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['trend']}</td>
                    <td>{$row['material']}</td>
                    <td>{$row['color']}</td>
                    <td>{$row['order_date']}</td>
                  </tr>";
          }
          echo "</tbody></table>";
          ?>
        </div>
      </div>
    </div>

    <!-- Users -->
    <div id="users" class="content-section">
      <h3>User Management</h3>
      <div class="card mt-4">
        <div class="card-header bg-dark text-white">All Users</div>
        <div class="card-body">
          <table class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $users = mysqli_query($conn, "SELECT * FROM users ORDER BY user_id DESC");
              while($u = mysqli_fetch_assoc($users)) {
                echo "<tr id='user-{$u['user_id']}'>
                  <td>{$u['user_id']}</td>
                  <td>{$u['full_name']}</td>
                  <td>{$u['email']}</td>
                  <td>{$u['phone']}</td>
                  <td>{$u['address']}</td>
                  <td>
                    <button class='btn btn-sm btn-primary'><i class='fas fa-edit'></i></button>
                    <button class='btn btn-sm btn-danger delete-user' data-id='{$u['user_id']}'><i class='fas fa-trash'></i></button>
                  </td>
                </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- User Order Details -->
    <div id="useractivity" class="content-section">
      <h3>User Order Details</h3>
      <div class="card mt-4">
        <div class="card-header bg-dark text-white">All Orders</div>
        <div class="card-body">
          <div class="row">
            <!-- Left: Order Table -->
            <div class="col-md-8">
              <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Trend</th>
                    <th>Material</th>
                    <th>Color</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT o.*, u.full_name FROM orders o JOIN users u ON o.user_id = u.user_id ORDER BY o.order_id DESC";
                  $result = mysqli_query($conn, $query);
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                      <td>{$row['order_id']}</td>
                      <td>{$row['full_name']}</td>
                      <td>{$row['trend']}</td>
                      <td>{$row['material']}</td>
                      <td>{$row['color']}</td>
                      <td>
                        <button class='btn btn-sm btn-info view-measurement' data-id='{$row['order_id']}'>Measurement</button>
                        <button class='btn btn-sm btn-warning view-homevisit' data-id='{$row['order_id']}'>Home Visit</button>
                        <button class='btn btn-sm btn-danger delete-order' data-id='{$row['order_id']}'><i class='fas fa-trash'></i></button>
                      </td>
                    </tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>

            <!-- Right: Details Panel -->
            <div class="col-md-4">
              <div id="details-output" class="border p-3 bg-light" style="min-height: 300px;">
                <p class="text-muted">Select an order to view details here.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Placeholder -->
    <div id="orders" class="content-section"><h3>Orders Section</h3></div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(function() {
      // Sidebar navigation
      $('.sidebar a').click(function(e) {
        e.preventDefault();
        $('.sidebar a').removeClass('active');
        $(this).addClass('active');
        $('.content-section').removeClass('active');
        $('#' + $(this).data('target')).addClass('active');
      });

      // Delete user
      $('.delete-user').click(function() {
        if (!confirm('Are you sure you want to delete this user?')) return;
        var userId = $(this).data('id');
        $.post('', { delete_user_id: userId }, function(response) {
          if (response.trim() === 'success') {
            $('#user-' + userId).fadeOut();
          } else {
            alert('Error deleting user.');
          }
        });
      });

      // Delete order
      $('.main-content').on('click', '.delete-order', function() {
        if (!confirm('Are you sure you want to delete this order?')) return;
        var orderId = $(this).data('id');
        $.post('', { delete_order_id: orderId }, function(response) {
          if (response.trim() === 'success') {
            $('button[data-id="' + orderId + '"]').closest('tr').fadeOut();
            $('#details-output').html('<p class="text-muted">Select an order to view details here.</p>');
          } else {
            alert('Error deleting order.');
          }
        });
      });

      // View Measurement
      $('.main-content').on('click', '.view-measurement', function() {
        const orderId = $(this).data('id');
        $.post('fetch_details.php', { order_id: orderId, type: 'measurement' }, function(res) {
          $('#details-output').html(res);
        });
      });

      // View Home Visit
      $('.main-content').on('click', '.view-homevisit', function() {
        const orderId = $(this).data('id');
        $.post('fetch_details.php', { order_id: orderId, type: 'homevisit' }, function(res) {
          $('#details-output').html(res);
        });
      });
    });
  </script>
</body>
</html>
