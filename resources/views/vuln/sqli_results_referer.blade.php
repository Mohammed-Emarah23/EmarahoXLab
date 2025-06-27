<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Result</title>
</head>
<body style="background: #111; color: #eee; font-family: Arial; padding: 20px;">

  <h2>Mitigating this vulnerability after discovering it 😉 </h2>

  @if($error)
    <div style="color: red;">Error: {{ $error }}</div>
  @endif

  @if(!empty($results))
    <table border="1" cellpadding="8" cellspacing="0">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach($results as $item)
          <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->desc }}</td>
            <td>{{ $item->price }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p> Result in burp 🙃</p>
  @endif


</body>
</html>
