<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Two-Factor Login</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e1e2f, #121212);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #f1f1f1;
            padding: 20px;
            font-size: 16px;
        }

        .auth-card {
            background: #1c1c1c;
            padding: 40px;
            border-radius: 16px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 30px rgba(0, 255, 204, 0.2);
            width: 100%;
        }

        .form-title {
            font-size: 30px;
            font-weight: bold;
            color: #1abc9c;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 14px;
            border: 1px solid #444;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            background-color: #2c2c2c;
            color: #fff;
            box-sizing: border-box;
        }

        .form-input:focus {
            border-color: #1abc9c;
            outline: none;
        }

        .form-text {
            font-size: 15px;
            color: #ddd;
            margin-bottom: 15px;
            font-weight: 500;
            line-height: 1.6;
        }

        .form-text strong {
            font-weight: bold;
        }

        .form-text .highlight {
            color: #1abc9c;
            font-weight: bold;
        }

        .toggle-link {
            font-size: 15px;
            color: #1abc9c;
            background: none;
            border: none;
            padding: 0;
            font-weight: bold;
            cursor: pointer;
            text-decoration: underline;
            transition: color 0.3s ease;
        }

        .toggle-link:hover {
            color: #16a085;
        }

        .toggle-link:focus {
            outline: none;
        }

        .btn-submit {
            background-color: #1abc9c;
            color: #121212;
            padding: 12px 20px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-left: auto;
            font-size: 15px;
        }

        .btn-submit:hover {
            background-color: #16a085;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .error-message {
            background-color: #2c0d0d;
            color: #e74c3c;
            border: 1px solid #e74c3c;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
        }

        label {
            display: block;
            font-size: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }
    </style>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body>

<div class="auth-card" x-data="{ recovery: false }">
    <div class="form-title">Two-Factor Authentication</div>

    <div class="form-text" x-show="! recovery">
        <strong>Please confirm access to your account</strong> by entering the 
        <span class="highlight">authentication code</span> provided by your authenticator application.
    </div>

    <div class="form-text" x-cloak x-show="recovery">
        <strong>Please confirm access to your account</strong> by entering one of your 
        <span class="highlight">emergency recovery codes</span>.
    </div>

    @if ($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div class="form-group" x-show="! recovery">
            <label for="code">Authentication Code</label>
            <input id="code" class="form-input" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code">
        </div>

        <div class="form-group" x-cloak x-show="recovery">
            <label for="recovery_code">Recovery Code</label>
            <input id="recovery_code" class="form-input" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code">
        </div>

        <div class="form-actions">
            <button type="button"
                class="toggle-link"
                x-show="! recovery"
                x-on:click="
                    recovery = true;
                    $nextTick(() => { $refs.recovery_code.focus() })
                ">
                Use a recovery code
            </button>

            <button type="button"
                class="toggle-link"
                x-cloak
                x-show="recovery"
                x-on:click="
                    recovery = false;
                    $nextTick(() => { $refs.code.focus() })
                ">
                Use an authentication code
            </button>

            <button class="btn-submit" type="submit">
                Log in
            </button>
        </div>
    </form>
</div>

</body>
</html>
