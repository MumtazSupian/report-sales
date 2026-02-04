<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        /* Layout */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: #111;
            color: white;
            padding: 25px 20px;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 35px;
            text-align: center;
        }

        .sidebar a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            color: white;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: white;
            color: black;
        }

        /* Content */
        .content {
            flex: 1;
            padding: 40px;
        }

        .content h1 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 15px;
            color: #555;
        }

        /* Card */
        .card {
            margin-top: 30px;
            padding: 25px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            max-width: 700px;
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Main Menu</h2>

        <!-- Navigasi ke RKA -->
        <a href="{{ url('rka/dashboard') }}">RKA</a>

        <!-- Menu lain kosong -->
        <a href="">Current Data</a>
        <a href="{{ url('leasing/dashboard') }}">Leasing</a>
        <a href="">Evalwira</a>
        <a href="{{ url('activity/dashboard') }}">Activity</a>
        <a href="">Summary</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h1>Welcome to Main Dashboard</h1>
        <p>Silakan pilih menu di sidebar untuk masuk ke modul yang tersedia.</p>

        <div class="card">
            <h3>Dashboard Utama</h3>
            <p>
                Halaman ini adalah pusat navigasi.
                Klik menu <b>RKA</b> untuk masuk ke modul RKA.
            </p>
        </div>
    </div>

</div>

</body>
</html>
