@extends('layouts.app')

@section('content')
    <div
        style="padding: 40px 20px; min-height: calc(100vh - 100px); display: flex; flex-direction: column; align-items: center;">

        <div style="text-align: center; margin-bottom: 40px;">
            <h1
                style="color: white; font-size: 24px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin: 0;">
                📈 Dashboard Actual
            </h1>
            <div style="width: 60px; height: 4px; background: #3182ce; margin: 10px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; font-size: 14px; margin-top: 5px;">Pilih data actual yang ingin kamu kelola.</p>
        </div>

        <div
            style="
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        width: 100%;
        max-width: 1200px;
    ">

            <div class="rka-card">
                <div class="icon-box">🚗</div>
                <h3>Actual DO By Type</h3>
                <p>Data aktual Delivery Order berdasarkan tipe mobil.</p>
                <a href="{{ route('current.actual-do-by-type.index') }}" class="rka-btn">Masuk</a>
            </div>

            <div class="rka-card">
                <div class="icon-box">📝</div>
                <h3>Actual SPK By Type</h3>
                <p>Data aktual SPK berdasarkan tipe mobil.</p>
                <a href="{{ route('current.actual-spk-by-type.index') }}" class="rka-btn">Masuk</a>
            </div>

            <div class="rka-card">
                <div class="icon-box">📞</div>
                <h3>Actual Inquiry By Type</h3>
                <p>Data aktual inquiry berdasarkan tipe kendaraan.</p>
                <a href="{{ route('current.actual-inquary-by-type.index') }}" class="rka-btn">Masuk</a>
            </div>

            <div class="rka-card">
                <div class="icon-box">🔍</div>
                <h3>Actual Source Inquiry</h3>
                <p>Data aktual inquiry berdasarkan sumber inquiry.</p>
                <a href="{{ route('current.actual-source-inquary.index') }}" class="rka-btn">Masuk</a>
            </div>

            <div class="rka-card">
                <div class="icon-box">📊</div>
                <h3>Actual Source DO Inquiry</h3>
                <p>Data aktual DO inquiry berdasarkan sumber inquiry.</p>
                <a href="{{ route('current.actual-source-do-inquary.index') }}" class="rka-btn">Masuk</a>
            </div>

            <div class="rka-card">
                <div class="icon-box">👥</div>
                <h3>Actual Salesforces</h3>
                <p>Data aktual grading salesforce per bulan.</p>
                <a href="{{ route('current.actual-salesforces.index') }}" class="rka-btn">Masuk</a>
            </div>

            <div class="rka-card">
                <div class="icon-box">🤝</div>
                <h3>Actual DO Salesforces</h3>
                <p>Data aktual DO berdasarkan salesforce.</p>
                <a href="{{ route('current.actual-do-salesforces.index') }}" class="rka-btn">Masuk</a>
            </div>

            <div class="rka-card">
                <div class="icon-box">🏦</div>
                <h3>Actual Sales By Leasing</h3>
                <p>Data aktual penjualan berdasarkan leasing.</p>
                <a href="{{ route('current.actual-sales-by-leasing.index') }}" class="rka-btn">Masuk</a>
            </div>

        </div>
    </div>

    <style>
        .rka-card {
            background: white;
            border-radius: 16px;
            padding: 25px 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        .rka-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .icon-box {
            font-size: 30px;
            background: #f0f7ff;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .rka-card h3 {
            color: #1a202c;
            font-size: 14px;
            /* Sedikit lebih kecil agar teks panjang tidak berantakan */
            font-weight: 700;
            margin-bottom: 8px;
        }

        .rka-card p {
            color: #718096;
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .rka-btn {
            background: #1a202c;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 12px;
            width: 100%;
            transition: 0.3s;
        }

        .rka-btn:hover {
            background: #3182ce;
            color: white;
        }

        /* Penyesuaian untuk layar HP agar tetap rapi (2 kolom) */
        @media (max-width: 768px) {
            div[style*="grid-template-columns"] {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
    </style>
@endsection
