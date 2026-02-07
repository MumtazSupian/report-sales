@extends('layouts.app')

@section('content')
    <div
        style="padding: 40px 20px; min-height: calc(100vh - 100px); display: flex; flex-direction: column; align-items: center;">

        <div style="text-align: center; margin-bottom: 40px;">
            <h1
                style="color: white; font-size: 24px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin: 0;">
                📊 Dashboard Activity
            </h1>
            <div style="width: 60px; height: 4px; background: #3182ce; margin: 10px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; font-size: 14px; margin-top: 5px;">Pilih modul yang ingin kamu kelola</p>
        </div>

        <div
            style="
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        width: 100%;
        max-width: 1000px;
    ">

            <div class="activity-card">
                <div class="icon-box">📋</div>
                <h3>Summary</h3>
                <p>Kelola data summary activity, rencana perbaikan, dan evaluasi pelaksanaan.</p>
                <a href="{{ route('summary.summary.index') }}" class="activity-btn">Masuk</a>
            </div>

            <div class="activity-card">
                <div class="icon-box">⚡</div>
                <h3>Action Summary</h3>
                <p>Kelola action plan dan tindak lanjut dari summary activity.</p>
                <a href="{{ route('summary.summaryaction.index') }}" class="activity-btn">Masuk</a>
            </div>

        </div>
    </div>

    <style>
        .activity-card {
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

        .activity-card:hover {
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

        .activity-card h3 {
            color: #1a202c;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .activity-card p {
            color: #718096;
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .activity-btn {
            background: #1a202c;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 12px;
            width: 100%;
            text-align: center;
            transition: 0.3s;
        }

        .activity-btn:hover {
            background: #3182ce;
            color: white;
        }
    </style>
@endsection
