@extends('layouts.app')

@section('title', 'Tambah Evaluasi Wiraniaga')

@section('content')
    <div style="padding: 40px 20px; min-height: 100vh;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-weight:800; color:#fff; letter-spacing:1px; text-transform:uppercase; margin-bottom:5px;">
                📝 INPUT DATA EVALUASI
            </h2>
            <p style="color: #8fb3d9;">Lengkapi formulir di bawah untuk menambah data kinerja wiraniaga</p>
        </div>

        <div
            style="background:#fff; max-width: 900px; margin: 0 auto; padding:30px; border-radius:14px; box-shadow:0 10px 30px rgba(0,0,0,0.2);">

            <form method="POST" action="{{ route('evaluasi.store') }}">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                    <div>
                        <label style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">SALES
                            HEAD</label>
                        <input type="text" name="nama_sales_head" required
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;"
                            placeholder="Nama Sales Head...">
                    </div>

                    <div>
                        <label style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">NAMA
                            SALES</label>
                        <input type="text" name="nama_sales" required
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;"
                            placeholder="Nama Sales...">
                    </div>

                    <div>
                        <label
                            style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">TANGGAL
                            MASUK</label>
                        <input type="date" name="tanggal_masuk" required
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;">
                    </div>

                    <div>
                        <label
                            style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">TANGGAL
                            EVALUASI</label>
                        <input type="date" name="tanggal_evaluasi" required
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;">
                    </div>

                    {{-- TAMBAHAN INPUT GRADING PERLU PERBAIKAN --}}
                    <div style="grid-column: span 2;">
                        <label
                            style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">GRADING
                            PERFORMA</label>
                        {{-- perbaikan --}}
                        <div style="grid-column: span 2;">
                            <label
                                style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">GRADING
                                PERFORMA (Otomatis)</label>
                            <input type="text" id="grading_display" name="grading" readonly
                                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; background-color: #f1f1f1; font-weight: 800; color: #333;"
                                value="FREELANCE">
                            <small style="color: #666;">*Terhitung otomatis berdasarkan rata-rata Jan, Feb, Mar</small>
                        </div>
                    </div>
                </div>

                <hr style="border:0; border-top:1px solid #eee; margin:30px 0;">

                <h3
                    style="font-size:15px; font-weight:800; color:#0d47a1; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                    📊 NILAI PENJUALAN BULANAN
                </h3>

                <div style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 10px; margin-bottom: 30px;">
                    @foreach (['jan', 'feb', 'mar', 'apr', 'mei', 'jun'] as $m)
                        <div style="text-align: center;">
                            <label
                                style="display:block; font-weight:700; color:#555; margin-bottom:5px; font-size:11px;">{{ strtoupper($m) }}</label>
                            <input type="number" name="{{ $m }}" value="0" min="0"
                                style="width:100%; padding:8px; border:1px solid #ddd; border-radius:6px; text-align:center; font-weight:600; color:#0d47a1;">
                        </div>
                    @endforeach
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">HASIL
                        EVALUASI</label>
                    <textarea name="evaluasi" rows="3" placeholder="Tulis hasil evaluasi di sini..."
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none; resize: none;"></textarea>
                </div>

                <div style="margin-bottom: 35px; width: 50%;">
                    <label style="display:block; font-weight:700; color:#333; margin-bottom:8px; font-size:13px;">TANGGAL
                        KELUAR (Optional)</label>
                    <input type="date" name="tanggal_keluar"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; outline:none;">
                </div>

                <div
                    style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 20px;">
                    <a href="{{ route('evaluasi.index') }}"
                        style="text-decoration:none; color:#666; font-weight:600; font-size:14px; display:flex; align-items:center; gap:5px;">
                        ← Batal & Kembali
                    </a>

                    <button type="submit"
                        style="background:#1e88e5; color:#fff; border:none; padding:12px 30px; border-radius:8px; font-weight:700; cursor:pointer; font-size:14px; transition:0.3s; box-shadow:0 4px 10px rgba(30,136,229,0.3);"
                        onmouseover="this.style.background='#1565c0'" onmouseout="this.style.background='#1e88e5'">
                        💾 SIMPAN DATA EVALUASI
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const inputs = ['jan', 'feb', 'mar'];
        inputs.forEach(id => {
            document.getElementsByName(id)[0].addEventListener('input', calculateGrade);
        });

        function calculateGrade() {
            let jan = parseInt(document.getElementsByName('jan')[0].value) || 0;
            let feb = parseInt(document.getElementsByName('feb')[0].value) || 0;
            let mar = parseInt(document.getElementsByName('mar')[0].value) || 0;

            let rataRata = (jan + feb + mar) / 3;
            let total = jan + feb + mar;
            let grade = "FREELANCE";
            let color = "#9e9e9e";

            if (rataRata >= 3) {
                grade = "PLATINUM";
                color = "#1a237e";
            } else if (rataRata >= 2) {
                grade = "GOLD";
                color = "#ff9800";
            } else if (rataRata >= 1) {
                grade = "SILVER";
                color = "#757575";
            } else if (total > 0) {
                grade = "TRAINEE";
                color = "#4caf50";
            }

            const display = document.getElementById('grading_display');
            display.value = grade;
            display.style.color = (grade === "PLATINUM" || grade === "GOLD") ? "#fff" : "#333";
            display.style.backgroundColor = color;
        }
    </script>

@endsection
