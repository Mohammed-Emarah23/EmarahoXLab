<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <title>Shopping Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  
  <style>
    body {
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
      font-family: "Poppins", sans-serif;
      min-height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
    }

    .cart-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
      padding: 40px 30px;
      max-width: 720px;
      width: 100%;
      text-align: center;
      color: #333;
    }

    h3 {
      font-weight: 700;
      margin-bottom: 30px;
      color: #6f42c1;
      letter-spacing: 1px;
    }

    table {
      border-collapse: separate;
      border-spacing: 0 15px;
      width: 100%;
    }

    thead th {
      background-color: #6f42c1;
      color: #fff;
      font-weight: 600;
      padding: 12px 15px;
      border-radius: 10px;
    }

    tbody tr {
      background-color: #f5f7fa;
      border-radius: 10px;
      transition: background-color 0.3s ease;
    }

    tbody tr:hover {
      background-color: #e1d9f7;
    }

    tbody td {
      padding: 12px 15px;
      vertical-align: middle;
      color: #555;
    }

    tbody img {
      border-radius: 10px;
      max-height: 60px;
      object-fit: cover;
      box-shadow: 0 2px 8px rgba(111, 66, 193, 0.25);
      transition: transform 0.3s ease;
    }

    tbody img:hover {
      transform: scale(1.05);
    }

    .btn-back {
      background-color: #6f42c1;
      border: none;
      color: #fff;
      padding: 12px 25px;
      border-radius: 50px;
      font-weight: 600;
      box-shadow: 0 5px 15px rgba(111, 66, 193, 0.4);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      display: inline-block;
      margin-top: 25px;
      text-decoration: none;
    }

    .btn-back:hover {
      background-color: #5a35a5;
      box-shadow: 0 7px 20px rgba(90, 53, 165, 0.6);
      text-decoration: none;
      color: #fff;
    }

    .empty-cart {
      color: #6f42c1;
      font-weight: 600;
      font-size: 22px;
      margin: 20px 0 10px;
    }

    .empty-text {
      color: #7d7d7d;
      font-size: 16px;
      margin-bottom: 20px;
      font-style: italic;
    }

    .cart-icon {
      font-size: 70px;
      margin-bottom: 15px;
      color: #6f42c1;
      user-select: none;
    }
  </style>
</head>
<body>
  <div class="cart-card">
    @if(count($cart) > 0)
      <h3>Your Shopping Cart</h3>
      <table>
        <thead>
          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price per Unit</th>
            <th>Total Price</th>
            <th>Image</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart as $id => $product)
          <tr>
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['qty'] }}</td>
            <td>${{ number_format($product['price'], 2) }}</td>
            <td>${{ number_format($product['price'] * $product['qty'], 2) }}</td>
            <td>
              <img
                src="{{ asset('images/' . $product['image']) }}"
                alt="{{ $product['name'] }}"
                loading="lazy"
              />
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <a href="{{ url('/home') }}" class="btn-back">← Back to Products</a>

    @else
      <div class="cart-icon">🛒</div>
      <div class="empty-cart">Your cart is empty</div>
      <div class="empty-text">Looks like you haven't added anything yet.</div>
      <a href="{{ url('/home') }}" class="btn-back">← Back to Products</a>
    @endif
  </div>
</body>
</html>
