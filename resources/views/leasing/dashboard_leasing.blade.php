@extends('layouts.app')

@section('content')
<div style="padding: 40px 20px; min-height: calc(100vh - 100px); display: flex; flex-direction: column; align-items: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="color: white; font-size: 26px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin: 0;">
            DASHBOARD LEASING
        </h1>
        <div style="width: 60px; height: 4px; background: #3182ce; margin: 12px auto; border-radius: 10px;"></div>
        <p style="color: #cbd5e0; font-size: 14px; margin-top: 5px;">Kelola data aktual transaksi leasing dengan cepat dan terorganisir.</p>
    </div>

    <div style="
        display: grid; 
        grid-template-columns: repeat(3, 1fr); 
        gap: 25px; 
        width: 100%; 
        max-width: 1000px; /* Disesuaikan karena hanya 3 kartu agar tidak terlalu renggang */
    ">
        
        <div class="leasing-card">
            <div class="icon-box">📩</div>
            <h3>Aktual Aplikasi In</h3>
            <p>Data aplikasi masuk dari berbagai leasing per bulan.</p>
            <a href="{{ route('leasing.aktual-aplikasi-in.index') }}" class="leasing-btn">Kelola Data</a>
        </div>

        <div class="leasing-card">
            <div class="icon-box">📝</div>
            <h3>Aktual PO</h3>
            <p>Data Purchase Order dari setiap leasing per bulan.</p>
            <a href="{{ route('leasing.aktual-po.index') }}" class="leasing-btn">Kelola Data</a>
        </div>

        <div class="leasing-card">
            <div class="icon-box">🚫</div>
            <h3>Aktual Reject</h3>
            <p>Data penolakan aplikasi dari berbagai leasing per bulan.</p>
            <a href="{{ route('leasing.aktual-reject.index') }}" class="leasing-btn">Kelola Data</a>
        </div>

    </div>
</div>

<style>
    /* Card Styling */
    .leasing-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 35px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .leasing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        background: #fdfdfd;
    }

    /* Icon Box */
    .icon-box {
        font-size: 35px;
        background: #f0f7ff;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
    }

    /* Text Styling */
    .leasing-card h3 {
        color: #1a202c;
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .leasing-card p {
        color: #4a5568;
        font-size: 13px;
        line-height: 1.5;
        margin-bottom: 25px;
        flex-grow: 1;
    }

    /* Button Styling */
    .leasing-btn {
        background: #1a202c;
        color: white;
        padding: 12px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .leasing-btn:hover {
        background: #3182ce;
        box-shadow: 0 8px 15px rgba(49,130,206,0.3);
        transform: scale(1.02);
    }
</style>
@endsection