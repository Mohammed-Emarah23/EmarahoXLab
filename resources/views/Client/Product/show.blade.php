<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Show Product</title>

  <!-- Font Awesome for Stars -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      padding: 40px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .product-wrapper {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .product-image {
      height: 100%;
      width: 100%;
      object-fit: cover;
      border-radius: 20px 0 0 20px;
    }

    .product-info {
      padding: 30px;
    }

    .product-info h2 {
      font-weight: bold;
      margin-bottom: 15px;
      color: #333;
    }

    .product-info h4 {
      color: #28a745;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .product-info p {
      font-size: 1rem;
      color: #666;
      margin-bottom: 20px;
    }

    .stars i {
      color: #f0ad4e;
    }

    .review-count {
      font-size: 0.9rem;
      color: #888;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row product-wrapper">
      <!-- صورة المنتج -->
      <div class="col-md-6 p-0">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image w-100 h-100">
      </div>

      <!-- تفاصيل المنتج -->
      <div class="col-md-6 product-info">
        <h2>{{ $product->name }}</h2>
        <h4>${{ $product->price }}</h4>
        <p>{{ $product->desc }}</p>

        <ul class="list-inline stars mb-2">
          <li class="list-inline-item"><i class="fa fa-star"></i></li>
          <li class="list-inline-item"><i class="fa fa-star"></i></li>
          <li class="list-inline-item"><i class="fa fa-star"></i></li>
          <li class="list-inline-item"><i class="fa fa-star"></i></li>
          <li class="list-inline-item"><i class="fa fa-star"></i></li>
        </ul>
        <div class="review-count">Reviews (24)</div>
      </div>
    </div>
  </div>

</body>
</html>
