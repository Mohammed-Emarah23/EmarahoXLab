<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Confirm Order</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .disabled-btn {
      pointer-events: none;
      opacity: 0.6;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <h3 class="mb-4">🧾 Confirm Your Order</h3>

    <h5 class="mb-3 text-muted">
      💰 Your Balance: 
      <span id="user-balance" data-balance="{{ Auth::user()->balance }}">
        {{ number_format(Auth::user()->balance, 2) }} $$
      </span>
    </h5>

    <form action="{{ route('confirmOrder') }}" method="POST" id="order-form">
      @csrf

      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price ($$)</th>
            <th>Total ($$)</th>
          </tr>
        </thead>
        <tbody id="order-table-body">
          @php $total = 0; @endphp
          @foreach($cart as $index => $product)
          @php
            $lineTotal = $product['price'] * $product['qty'];
            $total += $lineTotal;
          @endphp
          <tr data-index="{{ $index }}">
            <td>
              {{ $product['name'] }}
              <input type="hidden" name="item_name[]" value="{{ $product['name'] }}">
            </td>
            <td>
              <input type="number" name="qty[]" class="form-control qty-input" value="{{ $product['qty'] }}" min="1">
            </td>
            <td class="unit-price" data-price="{{ $product['price'] }}">{{ number_format($product['price'], 2) }}</td>
            <td class="line-total">{{ number_format($lineTotal, 2) }}</td>
            <input type="hidden" name="unit_price[]" class="unit-price-input" value="{{ $product['price'] }}">
          </tr>
          <tr>
            <td colspan="4">
              <div class="text-danger small item-warning d-none">
                ⚠️ You can't afford this quantity of "<strong>{{ $product['name'] }}</strong>" with your current balance.
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="text-end"><strong>Total</strong></td>
            <td><strong id="final-total">{{ number_format($total, 2) }} $$</strong></td>
          </tr>
        </tfoot>
      </table>

      <div id="balance-warning" class="alert alert-danger d-none">
        ⚠️ Your balance is not enough to complete this order.
      </div>

      <button type="submit" id="confirm-btn" class="btn btn-success btn-lg">✔ Confirm Order</button>
      <a href="{{ route('cartpage') }}" class="btn btn-secondary mt-3">← Back to Cart</a>
    </form>
  </div>

  <script>
    const qtyInputs = document.querySelectorAll('.qty-input');
    const balance = parseFloat(document.getElementById('user-balance').dataset.balance);
    const confirmBtn = document.getElementById('confirm-btn');
    const warning = document.getElementById('balance-warning');

    function updateTotals() {
      let finalTotal = 0;
      let hasIndividualWarning = false;

      qtyInputs.forEach((input) => {
        const row = input.closest('tr');
        const unitPrice = parseFloat(row.querySelector('.unit-price').dataset.price);
        const quantity = parseInt(input.value) || 1;
        const lineTotal = unitPrice * quantity;

        // Update line total
        row.querySelector('.line-total').textContent = lineTotal.toFixed(2);

        // Update hidden price field
        row.querySelector('.unit-price-input').value = unitPrice;

        // Individual warning
        const warningRow = row.nextElementSibling;
        const itemWarning = warningRow?.querySelector('.item-warning');
        if (itemWarning) {
          if (lineTotal > balance) {
            itemWarning.classList.remove('d-none');
            hasIndividualWarning = true;
          } else {
            itemWarning.classList.add('d-none');
          }
        }

        finalTotal += lineTotal;
      });

      // Update total
      document.getElementById('final-total').textContent = finalTotal.toFixed(2) + ' $$';

      // General warning
      if (finalTotal > balance || hasIndividualWarning) {
        warning.classList.remove('d-none');
        confirmBtn.classList.add('disabled-btn');
      } else {
        warning.classList.add('d-none');
        confirmBtn.classList.remove('disabled-btn');
      }
    }

    qtyInputs.forEach(input => {
      input.addEventListener('input', updateTotals);
    });

    updateTotals();
  </script>
</body>
</html>
