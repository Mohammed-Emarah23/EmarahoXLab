<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Command Executor</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e1e2f, #121212);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #f1f1f1;
            padding: 20px;
        }

        .auth-wrapper {
            width: 100%;
            padding: 20px;
        }

        .auth-card {
            background: #1c1c1c;
            padding: 40px;
            border-radius: 16px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 30px rgba(0, 255, 204, 0.2);
            text-align: center;
        }

        .form-title {
            font-size: 28px;
            font-weight: bold;
            color: #1abc9c;
            margin-bottom: 25px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 14px;
            border: 1px solid #444;
            border-radius: 8px;
            margin-top: 5px;
            font-size: 15px;
            background-color: #2c2c2c;
            color: #fff;
            box-sizing: border-box;
        }

        .form-input:focus {
            border-color: #1abc9c;
            outline: none;
        }

        .btn-run {
            background-color: #1abc9c;
            color: #121212;
            padding: 12px 20px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-run:hover {
            background-color: #16a085;
        }

        .output-title {
            font-size: 18px;
            color: #1abc9c;
            margin-top: 30px;
        }

        pre {
            background-color: #2c2c2c;
            padding: 15px;
            border-radius: 10px;
            text-align: left;
            overflow-x: auto;
            margin-top: 10px;
            color: #eee;
        }

        .back-btn {
            margin-top: 30px;
            text-decoration: none;
            background-color: transparent;
            border: 2px solid #1abc9c;
            color: #1abc9c;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #1abc9c;
            color: #121212;
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="form-title">Command Executor (Admin Only)</div>

            <form method="POST" action="{{route('execute')}}">
                @csrf
                <div class="form-group">
                    <label for="cmd">Shell Command</label>
                    <input type="text" name="cmd" id="cmd" class="form-input" placeholder="Type shell command...">
                </div>
                <button type="submit" class="btn-run">Run</button>
            </form>

            @if(isset($result))
                <div class="output-title">Output:</div>
                <pre>{{ $result }}</pre>
            @endif
        </div>
    </div>

    <a href="{{ route('backAH') }}" class="back-btn">Back to Home Page</a>

</body>
</html>

