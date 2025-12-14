<?php
include 'db.php';

// Handle AJAX actions (delete user / delete order)
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
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Admin Dashboard - Tailors Touch</title>

  <!-- Fonts & icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- Bootstrap (grid only) -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>

  <style>
    :root{
      --bg:#071428;
      --card-radius:14px;
      --muted: rgba(255,255,255,0.65);
      --glass-border: rgba(255,255,255,0.04);
      --shadow-lg: 0 18px 50px rgba(3,10,23,0.6);
    }

    /* THEME CLASSES */
    /* Theme 3 — Teal -> Blue (default) */
    .theme-teal {
      --accent-1: #00c6ff;
      --accent-2: #0072ff;
      --sidebar-grad: linear-gradient(180deg,#0072ff 0%, #00c6ff 100%);
      --btn-glow: rgba(0,198,255,0.12);
    }

    /* Theme 4 — Dark Gold -> Black */
    .theme-gold {
      --accent-1: #d4af37;
      --accent-2: #8d6e63;
      --sidebar-grad: linear-gradient(180deg,#d4af37 0%, #8d6e63 100%);
      --btn-glow: rgba(212,175,55,0.12);
    }

    /* Page background */
    html,body{ height:100%; margin:0; font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial; background:
      radial-gradient(900px 400px at -10% 10%, rgba(0,198,255,0.04), transparent),
      radial-gradient(900px 400px at 110% 90%, rgba(0,114,255,0.02), transparent),
      linear-gradient(180deg,#061226 0%, #071428 100%);
      color: #e6eef8; -webkit-font-smoothing:antialiased;
    }

    /* Sidebar */
    .sidebar {
      position:fixed; left:18px; top:18px; bottom:18px; width:260px;
      background: var(--sidebar-grad);
      border-radius:20px; padding:22px; box-shadow: var(--shadow-lg);
      display:flex; flex-direction:column; gap:18px; border: 1px solid var(--glass-border);
      transition: transform .3s ease;
    }
    .brand { display:flex; gap:12px; align-items:center; }
    .logo {
      width:52px; height:52px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700;
      background: rgba(255,255,255,0.06); color:#fff; border:1px solid rgba(255,255,255,0.06);
    }
    .brand h2 { margin:0; font-size:18px; font-weight:800; color:#fff; }
    .brand small { display:block; font-size:12px; color:rgba(255,255,255,0.9); margin-top:4px; }

    .nav { display:flex; flex-direction:column; gap:8px; margin-top:6px; }
    .nav a { display:flex; align-items:center; gap:12px; padding:10px 12px; color:rgba(255,255,255,0.92); text-decoration:none; border-radius:10px; font-weight:700; transition: all .2s; border:1px solid transparent; }
    .nav a i { width:20px; text-align:center; }
    .nav a:hover { transform: translateX(6px); background: rgba(255,255,255,0.03); }
    .nav a.active { background: rgba(255,255,255,0.06); }

    .mini-stats { margin-top:auto; display:flex; gap:10px; align-items:center; }
    .stat { background: rgba(255,255,255,0.03); padding:8px 10px; border-radius:10px; font-size:13px; color:var(--muted); display:flex; gap:8px; align-items:center; border:1px solid rgba(255,255,255,0.02); }
    .stat strong { color:#fff; font-weight:800; }

    /* Main */
    .main { margin-left:300px; padding:28px; transition: margin-left .35s; }

    .topbar { display:flex; justify-content:space-between; align-items:center; gap:16px; margin-bottom:14px; }
    .profile { display:flex; gap:12px; align-items:center; }
    .avatar { width:44px; height:44px; border-radius:10px; background: rgba(255,255,255,0.06); display:flex; align-items:center; justify-content:center; color:#071428; font-weight:800; border:1px solid rgba(255,255,255,0.04); }

    /* Theme switcher */
    .theme-switch { display:flex; gap:8px; align-items:center; }
    .theme-btn {
      padding:8px 10px; border-radius:10px; border:1px solid rgba(255,255,255,0.06); background:transparent; color:#fff; cursor:pointer; font-weight:700;
    }
    .theme-btn.active { box-shadow: 0 8px 30px var(--btn-glow); transform: translateY(-3px); }

    /* Cards grid */
    .cards { display:grid; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); gap:18px; margin-bottom:18px; }
    .card {
      border-radius: var(--card-radius); padding:18px; position:relative; background: linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.005));
      border:1px solid rgba(255,255,255,0.03); backdrop-filter: blur(6px); overflow:hidden; transition: transform .25s, box-shadow .25s;
    }
    .card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(3,10,23,0.6); }

    .kpi { display:flex; align-items:center; gap:12px; }
    .kpi .icon { width:56px; height:56px; border-radius:12px; display:flex; align-items:center; justify-content:center; background: rgba(255,255,255,0.03); font-size:20px; border:1px solid rgba(255,255,255,0.03); }
    .kpi h3 { margin:0; font-size:20px; color:#fff; }
    .kpi p { margin:0; color:var(--muted); font-size:13px; }

    .table-wrap { margin-top:12px; overflow:auto; border-radius:10px; }
    table.table { min-width:700px; background:transparent; border-collapse:collapse; }
    thead.thead-dark th { background: rgba(255,255,255,0.02); color:#eaf4ff; font-weight:800; border-bottom:1px solid rgba(255,255,255,0.04); }
    tbody tr { transition: background .15s, transform .15s; }
    tbody tr:hover { background: rgba(255,255,255,0.02); transform: translateX(4px); }
    td, th { padding:12px 10px; border:none; vertical-align:middle; color: #dfeefe; font-weight:600; font-size:14px; }

    /* Buttons */
    .btn-ghost { background: transparent; border:1px solid rgba(255,255,255,0.06); color:#eaf4ff; padding:8px 10px; border-radius:8px; transition: all .18s; font-weight:700; }
    .btn-ghost:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(3,10,23,0.08); }

    .btn-danger { background: linear-gradient(90deg,#ff6b6b,#ff4b4b); border:none; color:#fff; padding:8px 10px; border-radius:10px; font-weight:800; }
    .btn-primary {
      background: linear-gradient(90deg, var(--accent-1), var(--accent-2));
      border:none; color:#fff; padding:8px 12px; border-radius:10px; font-weight:800; box-shadow: 0 8px 30px var(--btn-glow);
    }

    /* Details panel (right side slide-in) */
    .details-panel {
      position:fixed; right:18px; top:18px; bottom:18px; width:420px; max-width:92%;
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border-radius:16px; padding:18px; box-shadow: var(--shadow-lg); border:1px solid rgba(255,255,255,0.03);
      transform: translateX(20px); opacity:0; transition: transform .28s cubic-bezier(.2,.9,.3,1), opacity .28s;
      display:flex; flex-direction:column; gap:12px; z-index:999;
      backdrop-filter: blur(8px);
    }
    .details-panel.open { transform: translateX(0); opacity:1; }
    .details-panel .close { align-self:flex-end; cursor:pointer; color:var(--muted); }

    /* Small responsive tweaks */
    @media (max-width: 1000px) {
      .sidebar { left:12px; right:12px; top:12px; bottom:auto; height:auto; width:auto; display:flex; flex-direction:row; align-items:center; padding:12px; gap:12px; border-radius:12px;}
      .main { margin-left:12px; padding:12px; }
      .cards { grid-template-columns: repeat(auto-fit,minmax(180px,1fr)); }
      table.table { min-width:600px; }
      .details-panel { position:fixed; left:12px; right:12px; top:auto; bottom:12px; width:auto; max-width:100%; }
    }

    /* small animations */
    .fade-in { animation: fadeInUp .6s cubic-bezier(.2,.9,.3,1) both; }
    @keyframes fadeInUp { from { opacity:0; transform: translateY(10px);} to { opacity:1; transform:translateY(0);} }
  </style>
</head>
<body class="theme-teal"> <!-- default theme set to teal (Theme 3) -->

  <!-- SIDEBAR -->
  <aside class="sidebar fade-in">
    <div class="brand">
      <div class="logo"><i class="fas fa-cut"></i></div>
      <div>
        <h2>Tailors Touch</h2>
        <small>Admin Panel</small>
      </div>
    </div>

    <nav class="nav" aria-label="Main navigation">
      <a href="#" class="active" data-target="dashboard"><i class="fas fa-gauge-high"></i> Dashboard</a>
      <a href="#" data-target="orders"><i class="fas fa-box-open"></i> Orders</a>
      <a href="#" data-target="users"><i class="fas fa-users"></i> Users</a>
      <a href="#" data-target="useractivity"><i class="fas fa-list-check"></i> User Order Details</a>
    </nav>

    <div class="mini-stats">
      <div class="stat"><div style="width:8px;height:8px;border-radius:50%;background:var(--accent-1);margin-right:8px"></div><div><div style="font-size:11px;color:rgba(255,255,255,0.8)">Orders</div><strong id="stat-orders">0</strong></div></div>
      <div class="stat"><div style="width:8px;height:8px;border-radius:50%;background:#2ecc71;margin-right:8px"></div><div><div style="font-size:11px;color:rgba(255,255,255,0.8)">Users</div><strong id="stat-users">0</strong></div></div>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <div class="topbar">
      <div style="display:flex;flex-direction:column">
        <div style="font-size:13px;color:var(--muted)">Welcome back</div>
        <div style="font-weight:800;font-size:18px">Admin</div>
      </div>

      <div style="display:flex; gap:12px; align-items:center;">
        <div class="theme-switch">
          <button class="theme-btn" id="btn-theme-teal" title="Teal / Blue theme">Teal-Blue</button>
          <button class="theme-btn" id="btn-theme-gold" title="Gold / Dark theme">Gold</button>
        </div>
        <div class="profile" style="margin-left:8px">
          <div class="avatar">A</div>
        </div>
      </div>
    </div>

    <!-- KPI Cards -->
    <section class="cards">
      <div class="card">
        <div class="kpi">
          <div class="icon"><i class="fas fa-box-open"></i></div>
          <div>
            <h3 id="kpi-orders">0</h3>
            <p>Recent Orders</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="kpi">
          <div class="icon"><i class="fas fa-users"></i></div>
          <div>
            <h3 id="kpi-users">0</h3>
            <p>Total Users</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="kpi">
          <div class="icon"><i class="fas fa-eye"></i></div>
          <div>
            <h3 id="kpi-visits">0</h3>
            <p>Site Visits</p>
          </div>
        </div>
      </div>
    </section>

    <!-- DASHBOARD: Recent Orders -->
    <div id="dashboard" class="content-section active">
      <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
          <h4 style="margin:0">Recent Orders</h4>
          <small style="color:var(--muted)">Latest 10 orders</small>
        </div>

        <div class="table-wrap mt-3">
          <?php
          $recent_orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_id DESC LIMIT 10");
          echo "<table class='table table-hover'>
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
                    <td>#{$row['order_id']}</td>
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

    <!-- USERS -->
    <div id="users" class="content-section" style="display:none;">
      <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
          <h4 style="margin:0">User Management</h4>
        </div>

        <div class="table-wrap mt-3">
          <table class="table table-hover">
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
                  <td>#{$u['user_id']}</td>
                  <td>{$u['full_name']}</td>
                  <td>{$u['email']}</td>
                  <td>{$u['phone']}</td>
                  <td>{$u['address']}</td>
                  <td>
                    <button class='btn-ghost' title='Edit'><i class='fas fa-edit'></i></button>
                    <button class='btn-danger delete-user' data-id='{$u['user_id']}' title='Delete'><i class='fas fa-trash'></i></button>
                  </td>
                </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- USER ORDER DETAILS -->
    <div id="useractivity" class="content-section" style="display:none;">
      <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
          <h4 style="margin:0">User Order Details</h4>
        </div>

        <div class="row mt-3">
          <div class="col-md-8">
            <div class="table-wrap">
              <table class="table table-hover">
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
                      <td>#{$row['order_id']}</td>
                      <td>{$row['full_name']}</td>
                      <td>{$row['trend']}</td>
                      <td>{$row['material']}</td>
                      <td>{$row['color']}</td>
                      <td>
                        <button class='btn-ghost view-measurement' data-id='{$row['order_id']}' title='Measurement'>Measurement</button>
                        <button class='btn-ghost view-homevisit' data-id='{$row['order_id']}' title='Home Visit'>Home Visit</button>
                        <button class='btn-danger delete-order' data-id='{$row['order_id']}' title='Delete'><i class='fas fa-trash'></i></button>
                      </td>
                    </tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-4">
            <!-- (left intentionally blank — details shown in right-side panel) -->
            <div style="min-height:320px; border-radius:12px; background: transparent;"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ORDERS -->
    <div id="orders" class="content-section" style="display:none;">
      <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
          <h4 style="margin:0">All Orders</h4>
          <div style="color:var(--muted); font-size:13px;">Manage and preview orders</div>
        </div>

        <div class="table-wrap mt-3">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Category</th>
                <th>Trend</th>
                <th>Material</th>
                <th>Color</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $orders = mysqli_query($conn, "SELECT o.*, u.full_name FROM orders o JOIN users u ON o.user_id = u.user_id ORDER BY o.order_id DESC");
              while($o = mysqli_fetch_assoc($orders)) {
                echo "<tr>
                  <td>#{$o['order_id']}</td>
                  <td>{$o['full_name']}</td>
                  <td>{$o['category']}</td>
                  <td>{$o['trend']}</td>
                  <td>{$o['material']}</td>
                  <td>{$o['color']}</td>
                  <td>{$o['order_date']}</td>
                  <td>
                    <button class='btn-ghost view-measurement' data-id='{$o['order_id']}' title='Measurement'>Measurement</button>
                    <button class='btn-ghost view-homevisit' data-id='{$o['order_id']}' title='Home Visit'>Home Visit</button>
                    <button class='btn-danger delete-order' data-id='{$o['order_id']}' title='Delete'><i class='fas fa-trash'></i></button>
                  </td>
                </tr>";
              }
              ?>
            </tbody>
          </table>

          <!-- Order details panel trigger / placeholder is global (right side) -->
        </div>
      </div>
    </div>

  </main>

  <!-- RIGHT-SIDE DETAILS PANEL (Used for Measurement & Home Visit) -->
  <aside class="details-panel" id="detailsPanel" aria-hidden="true" style="display:none;">
    <div style="display:flex; justify-content:space-between; align-items:center;">
      <h5 style="margin:0">Order Details</h5>
      <div class="close" id="detailsClose" title="Close"><i class="fas fa-times"></i></div>
    </div>
    <div id="detailsContent" style="overflow:auto; color:#dbeafe; font-weight:600;">
      <p style="color:var(--muted); margin:0;">Select an order action to view details here.</p>
    </div>
  </aside>

  <!-- SCRIPTS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script>
    (function($){
      $(function(){

        // Sidebar nav switching
        $('.nav a').on('click', function(e){
          e.preventDefault();
          $('.nav a').removeClass('active');
          $(this).addClass('active');
          var target = $(this).data('target');
          $('.content-section').hide().removeClass('active');
          $('#' + target).fadeIn(180).addClass('active');
          // close details panel when switching sections
          closeDetails();
        });

        // Theme switching
        function setTheme(theme) {
          if (theme === 'teal') {
            document.body.classList.remove('theme-gold');
            document.body.classList.add('theme-teal');
            $('#btn-theme-teal').addClass('active'); $('#btn-theme-gold').removeClass('active');
          } else {
            document.body.classList.remove('theme-teal');
            document.body.classList.add('theme-gold');
            $('#btn-theme-gold').addClass('active'); $('#btn-theme-teal').removeClass('active');
          }
          localStorage.setItem('tt_theme', theme);
        }
        // on click
        $('#btn-theme-teal').on('click', function(){ setTheme('teal'); });
        $('#btn-theme-gold').on('click', function(){ setTheme('gold'); });
        // load saved theme
        var savedTheme = localStorage.getItem('tt_theme') || 'teal';
        setTheme(savedTheme);

        // Delete user
        $(document).on('click', '.delete-user', function(){
          if (!confirm('Are you sure you want to delete this user?')) return;
          var userId = $(this).data('id');
          var row = $('#user-' + userId);
          $.post('', { delete_user_id: userId }, function(response){
            if ($.trim(response) === 'success') {
              row.fadeOut(250, function(){ $(this).remove(); updateStats(); });
            } else { alert('Error deleting user.'); }
          });
        });

        // Delete order
        $(document).on('click', '.delete-order', function(){
          if (!confirm('Are you sure you want to delete this order?')) return;
          var orderId = $(this).data('id');
          var row = $(this).closest('tr');
          $.post('', { delete_order_id: orderId }, function(response){
            if ($.trim(response) === 'success') {
              row.fadeOut(250, function(){ $(this).remove(); updateStats(); });
              // if detailsPanel shows same order, clear it
              var currentHtml = $('#detailsContent').data('order-id');
              if (currentHtml == orderId) { closeDetails(); }
            } else { alert('Error deleting order.'); }
          });
        });

        // Open details panel helper
        function openDetails(htmlContent, orderId) {
          $('#detailsContent').html(htmlContent).data('order-id', orderId || '');
          $('#detailsPanel').show().addClass('open').attr('aria-hidden','false');
        }
        function closeDetails(){ $('#detailsPanel').removeClass('open').hide().attr('aria-hidden','true'); $('#detailsContent').html('<p style=\"color:var(--muted); margin:0;\">Select an order action to view details here.</p>').data('order-id',''); }

        $('#detailsClose').on('click', function(){ closeDetails(); });

        // View Measurement (works in Orders, User Order Details, Dashboard tables)
        $(document).on('click', '.view-measurement', function(){
          var orderId = $(this).data('id');
          openDetails('<p style="color:var(--muted); margin:0;">Loading measurement...</p>', orderId);
          $.post('fetch_details.php', { order_id: orderId, type: 'measurement' }, function(res){
            openDetails(res, orderId);
          }).fail(function(){ $('#detailsContent').html('<p style=\"color:var(--muted)\">Error loading measurement.</p>'); });
        });

        // View Home Visit
        $(document).on('click', '.view-homevisit', function(){
          var orderId = $(this).data('id');
          openDetails('<p style="color:var(--muted); margin:0;">Loading home visit details...</p>', orderId);
          $.post('fetch_details.php', { order_id: orderId, type: 'homevisit' }, function(res){
            openDetails(res, orderId);
          }).fail(function(){ $('#detailsContent').html('<p style=\"color:var(--muted)\">Error loading homevisit details.</p>'); });
        });

        // Small KPI updater (counts rows)
        function updateStats(){
          var ordersCount = $('table tbody tr').length;
          var usersCount = $('#users table tbody tr').length || $('table tbody tr').filter(function(){ return $(this).find('td:first').text().trim().charAt(0) === '#'; }).length;
          $('#kpi-orders').text(ordersCount); $('#stat-orders').text(ordersCount);
          $('#kpi-users').text(usersCount); $('#stat-users').text(usersCount);
          var visits = Math.max(150, ordersCount * 12);
          $('#kpi-visits').text(visits);
        }
        // initial stats
        updateStats();

        // close panel if click outside (desktop)
        $(document).mouseup(function(e){
          var container = $("#detailsPanel");
          if (!container.is(e.target) && container.has(e.target).length === 0) {
            // keep it open if user clicked a measurement/homevisit button recently — optional: close after small delay
            // closeDetails();
          }
        });

      });
    })(jQuery);
  </script>

</body>
</html>
