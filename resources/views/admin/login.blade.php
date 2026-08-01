<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Coffee Shop</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #f4f0e8; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .card { background: #fff; padding: 32px; border-radius: 12px; width: 100%; max-width: 380px; box-shadow: 0 4px 16px rgba(0,0,0,0.1); }
        h1 { font-size: 1.3rem; color: #2b1d12; margin-bottom: 24px; text-align: center; }
        label { display: block; font-size: 0.85rem; font-weight: 600; color: #4b2e1e; margin-bottom: 4px; }
        input { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; margin-bottom: 16px; font-size: 0.95rem; }
        input:focus { outline: none; border-color: #4b2e1e; }
        button { width: 100%; padding: 10px; background: #4b2e1e; color: #fff; border: none; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        button:hover { background: #6b4226; }
        .error { color: #b00020; font-size: 0.82rem; margin-top: -12px; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>☕ Admin Coffee Shop</h1>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>