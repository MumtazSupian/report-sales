<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Actual</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #f9fafb, #eef2f7);
            margin: 0;
            padding: 0;
            color: #111827;
        }

        .container {
            max-width: 1000px;
            margin: 60px auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            color: #6b7280;
            font-size: 16px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #111827, #374151);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .card h2 {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .card p {
            font-size: 15px;
            margin-bottom: 25px;
            color: #6b7280;
            line-height: 1.5;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: #111827;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .btn:hover {
            background: #1f2937;
            transform: translateX(4px);
        }

        .icon {
            font-size: 18px;
        }

        footer {
            text-align: center;
            margin-top: 60px;
            font-size: 13px;
            color: #9ca3af;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            <h1>📈 Dashboard Actual</h1>
            <p>Pilih data actual yang ingin kamu kelola</p>
        </div>

        <div class="grid">

            <div class="card">
                <h2>Actual DO By Type</h2>
                <p>Data aktual Delivery Order berdasarkan tipe mobil.</p>
                <a href="{{ route('current.actual-do-by-type.index') }}" class="btn">
                    <span class="icon">➡️</span> Masuk
                </a>
            </div>

            <div class="card">
                <h2>Actual SPK By Type</h2>
                <p>Data aktual SPK berdasarkan tipe mobil.</p>
                <a href="{{ route('current.actual-spk-by-type.index') }}" class="btn">
                    <span class="icon">➡️</span> Masuk
                </a>
            </div>

            <div class="card">
                <h2>Actual Inquiry By Type</h2>
                <p>Data aktual inquiry berdasarkan tipe kendaraan.</p>
                <a href="{{ route('current.actual-inquary-by-type.index') }}" class="btn">
                    <span class="icon">➡️</span> Masuk
                </a>
            </div>

            <div class="card">
                <h2>Actual Source Inquiry</h2>
                <p>Data aktual inquiry berdasarkan sumber inquiry.</p>
                <a href="{{ route('current.actual-source-inquary.index') }}" class="btn">
                    <span class="icon">➡️</span> Masuk
                </a>
            </div>

            <div class="card">
                <h2>Actual Source DO Inquiry</h2>
                <p>Data aktual DO inquiry berdasarkan sumber inquiry.</p>
                <a href="{{ route('current.actual-source-do-inquary.index') }}" class="btn">
                    <span class="icon">➡️</span> Masuk
                </a>
            </div>

            <div class="card">
                <h2>Actual Salesforces</h2>
                <p>Data aktual grading salesforce per bulan.</p>
                <a href="{{ route('current.actual-salesforces.index') }}" class="btn">
                    <span class="icon">➡️</span> Masuk
                </a>
            </div>

            <div class="card">
                <h2>Actual DO Salesforces</h2>
                <p>Data aktual DO berdasarkan salesforce.</p>
                <a href="{{ route('current.actual-do-salesforces.index') }}" class="btn">
                    <span class="icon">➡️</span> Masuk
                </a>
            </div>

            <div class="card">
                <h2>Actual Sales By Leasing</h2>
                <p>Data aktual penjualan berdasarkan leasing.</p>
                <a href="{{ route('current.actual-sales-by-leasing.index') }}" class="btn">
                    <span class="icon">➡️</span> Masuk
                </a>
            </div>

        </div>

        <footer>
            © {{ date('Y') }} Suzuki Activity · Built with ❤️
        </footer>

    </div>

</body>

</html>
