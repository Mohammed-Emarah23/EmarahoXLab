<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Products Page</title>
  <style>
    body {
      background-color: #121212;
      color: #ccc;
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    h1 {
      text-align: center;
      margin-bottom: 30px;
    }
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
    }
    th {
      background: #1abc9c;
      color: #121212;
      font-weight: 700;
      font-size: 16px;
    }
    tr:hover {
      background: #1abc9c33;
      color: #121212;
    }
    .product-img {
      width: 70px;
      height: 70px;
      object-fit: cover;
      border-radius: 6px;
    }

    .btn {
      padding: 6px 12px;
      margin: 0 3px;
      border: none;
      border-radius: 5px;
      font-weight: 600;
      cursor: pointer;
      color: white;
      transition: background-color 0.3s ease;
      font-size: 14px;
    }
    .btn.edit {
      background-color: #3498db;
    }
    .btn.edit:hover {
      background-color: #2980b9;
    }
    .btn.show {
      background-color: #2ecc71;
    }
    .btn.show:hover {
      background-color: #27ae60;
    }
    .btn.delete {
      background-color: #e74c3c;
    }
    .btn.delete:hover {
      background-color: #c0392b;
    }

    .back-btn, .add-btn {
      display: inline-block;
      margin: 20px 10px 0;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .back-btn {
      background-color: #1abc9c;
      color: #121212;
    }
    .back-btn:hover {
      background-color: #16a085;
    }

    .add-btn {
      background-color: #f39c12;
      color: #121212;
    }
    .add-btn:hover {
      background-color: #e67e22;
    }

    .buttons {
      text-align: center;
      margin-top: 30px;
    }

    a {
      text-decoration: none;
    }
  </style>
</head>
<body>

  <h1>Products List</h1>

  <table>
    <thead>
      <tr>
        <th>Product Number</th>
        <th>Product Name</th>
        <th>Product Description</th>
        <th>Product Price</th>
        <th>Product Image</th>
        <th>Product Quantity</th>
        <th>Actions</th>
      </tr> 
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->desc }}</td>
          <td>{{ $product->price }}</td>
          <td>
            <img src="{{ asset("storage/$product->image") }}" class="product-img" />
          </td>
          <td>{{ $product->quantity ?? 'N/A' }}</td>
          <td>
             <a href="{{route('edit-form',$product->id)}}">
              <button class="btn edit">Edit</button>
            </a>
            <form action="{{route('delete',$product->id)}}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="buttons">
    <a href="{{route('add-form')}}" class="add-btn">Add Product</a>
  </div>
 <a href="{{ route('backAH') }}" class="back-btn">Back to Home Page</a>
</body>
</html>
