@extends('layouts.app')

@section('content')
<div style="padding: 40px 20px; min-height: calc(100vh - 100px); display: flex; flex-direction: column; align-items: center;">
    
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="color: white; font-size: 24px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin: 0;">
            Dashboard Target (RKA)
        </h1>
        <div style="width: 60px; height: 4px; background: #3182ce; margin: 10px auto; border-radius: 10px;"></div>
        <p style="color: #cbd5e0; font-size: 14px; margin-top: 5px;">Pilih modul untuk mengelola rencana kerja anggaran.</p>
    </div>

    <div style="
        display: grid; 
        grid-template-columns: repeat(4, 1fr); 
        gap: 20px; 
        width: 100%; 
        max-width: 1200px; /* Menjaga agar tidak terlalu lebar di monitor raksasa */
    ">
        
        <div class="rka-card">
            <div class="icon-box">🚗</div>
            <h3>Target DO Unit</h3>
            <p>Rencana penjualan unit mobil bulanan.</p>
            <a href="{{ route('rka.target-do-units.index') }}" class="rka-btn">Kelola</a>
        </div>

        <div class="rka-card">
            <div class="icon-box">👥</div>
            <h3>Target Salesforce</h3>
            <p>Grading dan performa salesforce.</p>
            <a href="{{ route('rka.target-salesforces.index') }}" class="rka-btn">Kelola</a>
        </div>

        <div class="rka-card">
            <div class="icon-box">📞</div>
            <h3>Target Inquiries</h3>
            <p>Monitoring jumlah prospek masuk.</p>
            <a href="{{ route('rka.target-inquiries.index') }}" class="rka-btn">Kelola</a>
        </div>

        <div class="rka-card">
            <div class="icon-box">📊</div>
            <h3>Target DO by SOI</h3>
            <p>Analisis DO berdasarkan sumber prospek.</p>
            <a href="{{ route('rka.target-do-by-soi.index') }}" class="rka-btn">Kelola</a>
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
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        transition: 0.3s;
    }

    .rka-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.4);
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
        font-size: 16px;
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
    }
</style>
@endsection