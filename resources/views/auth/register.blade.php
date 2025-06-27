<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Form</title>
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

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            color: #ccc;
        }

        .link {
            font-size: 14px;
            color: #ccc;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .link:hover {
            color: #fff;
        }

        .btn-register {
            background-color: #1abc9c;
            color: #121212;
            padding: 12px 20px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: #16a085;
        }

        .status-message {
            margin-bottom: 15px;
            font-size: 14px;
            color: #2ecc71;
            text-align: center;
        }

        .error-message {
            background-color: #2c0d0d;
            color: #e74c3c;
            border: 1px solid #e74c3c;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="form-title">Register Form</div>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <x-label for="name" value="Name" />
                <x-input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="form-group">
                <x-label for="email" value="Email" />
                <x-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="form-group">
                <x-label for="password" value="Password" />
                <x-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="form-group">
                <x-label for="password_confirmation" value="Confirm Password" />
                <x-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="form-check">
                    <x-checkbox name="terms" id="terms" required />
                    <label for="terms" class="text-sm text-gray-400">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="link">Terms of Service</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="link">Privacy Policy</a>',
                        ]) !!}
                    </label>
                </div>
            @endif

            <div class="form-footer">
                <a class="link" href="{{ route('login') }}">
                    Already registered?
                </a>

                <x-button class="btn-register">
                    Register
                </x-button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
