<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Amikom Event Hub</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 32px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
        }
        .header {
            text-align: center;
            margin-bottom: 32px;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 8px;
        }
        .subtitle {
            color: #4b5563;
            font-size: 14px;
        }
        .alert {
            margin-bottom: 16px;
            padding: 16px;
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            border-radius: 4px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 4px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 14px;
            focus-outline: none;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }
        .error-text {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
        }
        button {
            width: 100%;
            padding: 8px 16px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #1d4ed8;
        }
        .credentials {
            margin-top: 24px;
            text-align: center;
            font-size: 12px;
            color: #4b5563;
        }
        .credentials p {
            margin: 4px 0;
        }
        .mono {
            font-family: monospace;
            background-color: #f3f4f6;
            padding: 2px 4px;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="header">
            <h1>Admin Login</h1>
            <p class="subtitle">Amikom Event Hub</p>
        </div>

        @if ($errors->any())
            <div class="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="admin@amikom.ac.id"
                    required
                >
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password"
                    placeholder="••••••••"
                    required
                >
                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Login</button>
        </form>

        <form action="{{ route('auth.google') }}" method="GET" style="margin-top: 16px;">
            <button type="submit" style="width: 100%; padding: 10px 16px; margin-top: 8px; background-color: #4285F4; color: white; border: none; border-radius: 4px; font-weight: bold; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" width="20" height="20">
                Login dengan Google
            </button>
        </form>

        <div class="credentials">
            <p><strong>Default Credentials:</strong></p>
            <p>Email: <span class="mono">admin@amikom.ac.id</span></p>
            <p>Password: <span class="mono">password</span></p>
        </div>
    </div>
</body>
</html>
