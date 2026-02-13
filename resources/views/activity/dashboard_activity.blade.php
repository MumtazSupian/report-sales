@extends('layouts.app')

@section('content')
    <div
        style="padding: 40px 20px; min-height: calc(100vh - 100px); display: flex; flex-direction: column; align-items: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

        <div style="text-align: center; margin-bottom: 40px;">
            <h1
                style="color: white; font-size: 26px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin: 0;">
                DASHBOARD ACTIVITY
            </h1>
            <div style="width: 60px; height: 4px; background: #3182ce; margin: 12px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; font-size: 14px; margin-top: 5px;">Kelola rencana dan realisasi aktivitas marketing
                dengan cepat dan terorganisir.</p>
        </div>

        <div
            style="
        display: grid; 
        grid-template-columns: repeat(2, 1fr); 
        gap: 25px; 
        width: 100%; 
        max-width: 750px; /* Lebar disesuaikan untuk 2 kartu agar pas di tengah */
    ">

            <div class="activity-card">
                <div class="icon-box">📅</div>
                <h3>Activity Plan</h3>
                <p>Susun rencana kegiatan, tentukan target (P, HP, SPK), dan estimasi budget mingguan/bulanan.</p>
                <a href="{{ route('activity.plan.index') }}" class="activity-btn">Kelola Data</a>
            </div>

            <div class="activity-card">
                <div class="icon-box">📊</div>
                <h3>Activity Actual</h3>
                <p>Input realisasi hasil kegiatan di lapangan dan pantau efektivitas biaya (Cost/P & Cost/SPK).</p>
                <a href="{{ route('activity.actual.index') }}" class="activity-btn">Kelola Data</a>
            </div>

        </div>
    </div>

    <style>
        .activity-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 35px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .activity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
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
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        /* Text Styling */
        .activity-card h3 {
            color: #1a202c;
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .activity-card p {
            color: #4a5568;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 25px;
            flex-grow: 1;
        }

        .activity-btn {
            background: #1a202c;
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .activity-btn:hover {
            background: #3182ce;
            box-shadow: 0 8px 15px rgba(49, 130, 206, 0.3);
            transform: scale(1.02);
        }
    </style>
@endsection
