<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>E-commerce Admin Dashboard</title>
  <style>
    /* Reset */
    * {
      margin: 0; padding: 0; box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      background-color: #121212;
      color: #e0e0e0;
      display: flex;
      min-height: 100vh;
    }
    /* Sidebar */
    .sidebar {
      width: 260px;
      background: #1f1f1f;
      color: #bbb;
      display: flex;
      flex-direction: column;
      padding: 25px 20px;
      position: fixed;
      top: 0; bottom: 0; left: 0;
      box-shadow: 2px 0 8px rgba(0,0,0,0.8);
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 35px;
      font-weight: 700;
      font-size: 24px;
      color: #1abc9c;
      letter-spacing: 2px;
    }
    .sidebar a {
      color: #bbb;
      padding: 14px 18px;
      margin-bottom: 12px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      display: block;
      transition: background 0.3s, color 0.3s;
    }
    .sidebar a:hover, .sidebar a.active {
      background: #1abc9c;
      color: #121212;
    }

    /* Main Content */
    .main-content {
      margin-left: 260px;
      flex: 1;
      padding: 30px 40px;
      background: #181818;
      min-height: 100vh;
    }

    header {
      margin-bottom: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      font-weight: 700;
      font-size: 28px;
      color: #1abc9c;
    }
    header .profile {
      background: #2a2a2a;
      padding: 10px 20px;
      border-radius: 30px;
      color: #ccc;
      font-weight: 600;
      cursor: pointer;
      user-select: none;
      transition: background 0.3s;
    }
    header .profile:hover {
      background: #1abc9c;
      color: #121212;
    }

    /* Stats Cards */
    .stats {
      display: flex;
      gap: 25px;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }
    .card {
      background: #252525;
      flex: 1 1 220px;
      padding: 25px 30px;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(26, 188, 156, 0.4);
      text-align: center;
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 20px rgba(26, 188, 156, 0.6);
    }
    .card h3 {
      margin-bottom: 15px;
      font-size: 20px;
      color: #80e0d8;
    }
    .card p {
      font-size: 36px;
      font-weight: 700;
      color: #1abc9c;
      letter-spacing: 1.2px;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      background: #252525;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 6px 15px rgba(26, 188, 156, 0.4);
    }
    th, td {
      padding: 16px 22px;
      text-align: left;
      border-bottom: 1px solid #333;
      color: #ccc;
    }
    th {
      background: #1abc9c;
      color: #121212;
      font-weight: 700;
      font-size: 16px;
    }
    tr:hover {
      background: #1abc9c33; /* transparent teal */
      color: #121212;
    }

    /* Status badges */
    .status {
      padding: 6px 14px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 14px;
      display: inline-block;
      color: #121212;
    }
    .status.completed {
      background-color: #27ae601a; /* green transparent */
      color: #27ae60;
    }
    .status.processing {
      background-color: #f39c121a; /* yellow transparent */
      color: #f39c12;
    }
    .status.cancelled {
      background-color: #e74c3c1a; /* red transparent */
      color: #e74c3c;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        width: 70px;
        padding: 20px 10px;
      }
      .sidebar h2 {
        display: none;
      }
      .sidebar a {
        font-size: 12px;
        padding: 12px 8px;
      }
      .main-content {
        margin-left: 70px;
        padding: 20px;
      }
      .stats {
        flex-direction: column;
        gap: 15px;
      }
    }
  </style>
</head>
<body>
  <aside class="sidebar">
    <h2>Admin Dashboard</h2>
    <a href="{{url('/dashboard')}}" class="active">Dashboard</a>
    <a href="{{route('all-products')}}">Products</a>
    <a href="{{url('/user/profile')}}">Settings</a>
     <a href="{{route('AdminWeb')}}">Website</a>
     <a href="{{route('Terminal')}}">Terminal</a>
  </aside>

  <main class="main-content">
    <header>
      <h1>Dashboard Overview</h1>
      <div class="profile">{{Auth::user()->name}}</div>
    </header>

    <section class="stats">
      <div class="card">
        <h3>Total Products</h3>
        <p id="productsCount">350</p>
      </div>
      <div class="card">
        <h3>Orders Today</h3>
        <p id="ordersCount">120</p>
      </div>
      <div class="card">
        <h3>Total Revenue</h3>
        <p id="revenueCount">$18,450</p>
      </div>
      <div class="card">
        <h3>New Customers</h3>
        <p id="customersCount">45</p>
      </div>
    </section>

    <section>
      <h2>Users Management</h2>
      <br>
      <table>
        <thead>
          <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>email</th>
            <th>role</th>
          </tr>
        </thead>
  @foreach ($user as $u )
      <tbody id="ordersTableBody">
          <tr>
            <td>{{$u->id}}</td>
            <td>{{$u->name}}</td>
            <td>{{$u->email}}</td>
            <td>{{$u->role}}</td>
          </tr>
        </tbody>
  @endforeach
      </table>
    </section>
  </main>

  <script>
    // Optional: Update stats dynamically
    const productsCount = document.getElementById("productsCount");
    const ordersCount = document.getElementById("ordersCount");
    const revenueCount = document.getElementById("revenueCount");
    const customersCount = document.getElementById("customersCount");

    setInterval(() => {
      productsCount.textContent = 300 + Math.floor(Math.random() * 100);
      ordersCount.textContent = 80 + Math.floor(Math.random() * 60);
      revenueCount.textContent = '$' + (15000 + Math.floor(Math.random() * 5000));
      customersCount.textContent = 30 + Math.floor(Math.random() * 30);
    }, 7000);
  </script>
</body>
</html>
