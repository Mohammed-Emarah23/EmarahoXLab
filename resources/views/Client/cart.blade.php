<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Shopping Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
    body {
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
      font-family: "Poppins", sans-serif;
      min-height: 100vh;
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
      max-width: 900px;
      width: 100%;
      color: #333;
    }

    h3 {
      font-weight: 700;
      margin-bottom: 30px;
      color: #6f42c1;
      text-align: center;
    }

    table {
      width: 100%;
    }

    thead th {
      background-color: #6f42c1;
      color: #fff;
      font-weight: 600;
      padding: 12px;
      text-align: center;
    }

    tbody td {
      padding: 12px;
      text-align: center;
      vertical-align: middle;
      color: #555;
    }

    .btn-primary {
      background-color: #6f42c1;
      border: none;
      font-weight: 600;
    }

    .btn-primary:hover {
      background-color: #5a35a5;
    }

    .btn-back {
      background-color: #6f42c1;
      border: none;
      color: #fff;
      padding: 10px 20px;
      border-radius: 50px;
      font-weight: 600;
      box-shadow: 0 5px 15px rgba(111, 66, 193, 0.4);
      transition: 0.3s ease;
      display: inline-block;
      margin-top: 25px;
      text-decoration: none;
    }

    .btn-back:hover {
      background-color: #5a35a5;
      color: #fff;
    }

    .cart-icon {
      font-size: 70px;
      margin-bottom: 15px;
      color: #6f42c1;
      user-select: none;
      text-align: center;
    }

    .alert {
      margin-top: 20px;
    }

    .actions {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .empty-cart,
    .empty-text {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="cart-card">

    {{-- Alerts --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($cart) > 0)
      <h3>🛒 Your Shopping Cart</h3>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price/Unit</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="cart-body">
          @php $total = 0; @endphp
          @foreach($cart as $id => $product)
            @php $lineTotal = $product['price'] * $product['qty']; @endphp
            @php $total += $lineTotal; @endphp
            <tr data-id="{{ $id }}">
              <td>{{ $product['name'] }}</td>
              <td>
                <input type="number" min="1" class="form-control qty-input" value="{{ $product['qty'] }}" style="width: 80px; margin: auto;" />
              </td>
              <td>{{ number_format($product['price'], 2) }} $$ </td>
              <td class="line-total">{{ number_format($lineTotal, 2) }} $$ </td>
              <td><button class="btn btn-sm btn-danger remove-btn">🗑</button></td>
            </tr>
          @endforeach
          <tr>
            <td colspan="3" class="text-end fw-bold">Total</td>
            <td colspan="2" class="fw-bold" id="grand-total">{{ number_format($total, 2) }} $$</td>
          </tr>
        </tbody>
      </table>

      <div class="actions">
        <a href="{{ url('/home') }}" class="btn-back">← Back to Products</a>
        <a href="{{ route('reviewOrder') }}" class="btn btn-primary px-4">Make Order</a>
      </div>
    @else
      <div class="cart-icon">🛒</div>
      <div class="empty-cart text-danger fw-bold">Your cart is empty</div>
      <div class="empty-text text-muted">Looks like you haven't added anything yet.</div>
      <a href="{{ url('/home') }}" class="btn-back">← Back to Products</a>
    @endif

  </div>

  <script>
    document.querySelectorAll('.remove-btn').forEach(button => {
      button.addEventListener('click', function () {
        let row = this.closest('tr');
        let productId = row.dataset.id;

        fetch("{{ route('cart.remove') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ id: productId })
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            row.remove();
            updateTotal();

            if (document.querySelectorAll('#cart-body tr[data-id]').length === 0) {
              document.querySelector('.cart-card').innerHTML = `
                <div class="cart-icon">🛒</div>
                <div class="empty-cart text-danger fw-bold">Your cart is empty</div>
                <div class="empty-text text-muted">Looks like you haven't added anything yet.</div>
                <a href='{{ url("/home") }}' class='btn-back'>← Back to Products</a>
              `;
            }
          }
        });
      });
    });

    function updateTotal() {
      let total = 0;
      document.querySelectorAll('.line-total').forEach(cell => {
        let val = parseFloat(cell.innerText.replace(' $$ ', ''));
        total += val;
      });
      document.getElementById('grand-total').innerText = total.toFixed(2) + ' $$';
    }
  </script>
</body>
</html>
