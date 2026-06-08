<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Amikom Event Hub</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
        }
        nav {
            background-color: white;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            padding: 0 16px;
            min-height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        nav h1 {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
        }
        nav .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        nav span {
            color: #374151;
        }
        nav button {
            background-color: #dc2626;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }
        nav button:hover {
            background-color: #b91c1c;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 16px;
        }
        .dashboard-content {
            background-color: white;
            border: 2px dashed #e5e7eb;
            border-radius: 8px;
            padding: 32px;
        }
        .dashboard-content h2 {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 16px;
        }
        .dashboard-content p {
            color: #4b5563;
            margin-bottom: 24px;
        }
        .action-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        .action-btn {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            padding: 12px 16px;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.2s;
        }
        .action-btn:hover {
            background-color: #1d4ed8;
        }
        .action-btn.green {
            background-color: #16a34a;
        }
        .action-btn.green:hover {
            background-color: #15803d;
        }
        .action-btn.purple {
            background-color: #9333ea;
        }
        .action-btn.purple:hover {
            background-color: #7e22ce;
        }
    </style>
</head>
<body>
    <nav>
        <h1>Admin Dashboard</h1>
        <div class="user-info">
            <span>{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('admin.logout') }}" style="margin: 0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="dashboard-content">
            <h2>Selamat datang di Admin Panel</h2>
            <p>Anda telah berhasil login sebagai Admin.</p>
            
            <div class="action-links">
                <a href="{{ route('admin.events.index') }}" class="action-btn">Kelola Events</a>
                <a href="{{ route('admin.transactions.index') }}" class="action-btn green">Lihat Transactions</a>
                <a href="{{ route('admin.categories.index') }}" class="action-btn purple">Kelola Categories</a>
            </div>
        </div>
    </div>
</body>
</html>