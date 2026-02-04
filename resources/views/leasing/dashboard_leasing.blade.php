<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Leasing</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 10px;
            color: #111;
        }

        p {
            color: #555;
            margin-bottom: 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card h2 {
            margin: 0;
            font-size: 18px;
            color: #111;
        }

        .card p {
            font-size: 14px;
            margin: 10px 0 20px;
            color: #666;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            background: black;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .btn:hover {
            background: #333;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Dashboard Leasing</h1>
        <p>Pilih tabel aktual yang ingin kamu kelola.</p>

        <div class="grid">
            <!-- Kartu 1 -->
            <div class="card">
                <h2>Aktual Aplikasi In</h2>
                <p>Kelola data aktual aplikasi masuk dari berbagai leasing per bulan.</p>
                <a href="{{ route('leasing.aktual-aplikasi-in.index') }}" class="btn">
                    Masuk
                </a>
            </div>

            <!-- Kartu 2 -->
            <div class="card">
                <h2>Aktual PO</h2>
                <p>Kelola data aktual Purchase Order dari setiap leasing per bulan.</p>
                <a href="{{ route('leasing.aktual-po.index') }}" class="btn">
                    Masuk
                </a>
            </div>

            <!-- Kartu 3 -->
            <div class="card">
                <h2>Aktual Reject</h2>
                <p>Kelola data aktual penolakan dari berbagai leasing per bulan.</p>
                <a href="{{ route('leasing.aktual-reject.index') }}" class="btn">
                    Masuk
                </a>
            </div>

        </div>

</body>

</html>
