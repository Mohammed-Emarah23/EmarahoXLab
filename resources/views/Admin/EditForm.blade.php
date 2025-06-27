<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Product</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background: linear-gradient(135deg, #1e1e2f, #121212);
      color: #f1f1f1;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .container {
      background: #1c1c1c;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 0 30px rgba(0, 255, 204, 0.2);
      width: 100%;
      max-width: 600px;
    }

    h1 {
      text-align: center;
      color: #1abc9c;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #ccc;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 14px;
      margin-bottom: 20px;
      border: 1px solid #444;
      border-radius: 8px;
      background-color: #2c2c2c;
      color: #fff;
      font-size: 15px;
    }

    textarea {
      resize: vertical;
      min-height: 90px;
    }

    button[type="submit"] {
      width: 100%;
      background-color: #1abc9c;
      color: #121212;
      font-weight: 700;
      padding: 14px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #16a085;
    }

    .back-btn {
      display: block;
      margin-top: 25px;
      text-align: center;
      background-color: #3498db;
      color: #fff;
      padding: 12px;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .back-btn:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Edit Product</h1>

    <form action="{{ route('edit', $product->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <label for="name">Product Name</label>
      <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>

      <label for="desc">Product Description</label>
      <textarea id="desc" name="desc" required>{{ old('desc', $product->desc ?? '') }}</textarea>

      <label for="price">Product Price</label>
      <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $product->price ?? '') }}" required>

      <label for="image">Product Image</label>
      <input type="file" id="image" name="image" accept="image/*">
    

      <label for="quantity">Product Quantity</label>
      <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}" required>

      <button type="submit">Update Product</button>
    </form>

    <a href="{{ route('all-products') }}" class="back-btn">Back to Products List</a>
  </div>

</body>
</html>
