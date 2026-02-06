@extends('layouts.app')

@section('title', 'Tambah Aktual PO')

@section('content')
    <div style="padding: 40px 20px; display: flex; flex-direction: column; align-items: center; min-height: 100vh;">

        {{-- Header Section --}}
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-weight:800; color:#fff; letter-spacing:1px; text-transform:uppercase; margin:0;">
                TAMBAH AKTUAL PO
            </h2>
            <div style="width: 50px; height: 4px; background: #3182ce; margin: 10px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; font-size: 14px;">Input realisasi Purchase Order per leasing tahunan</p>
        </div>

        {{-- Form Card --}}
        <div style="background: white; width: 100%; max-width: 700px; padding: 35px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <form id="aktualPoForm" action="{{ route('leasing.aktual-po.store') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 10px;">
                    <div>
                        <label style="display: block; font-weight: 700; color: #2d3748; margin-bottom: 8px; font-size: 13px; text-transform: uppercase;">
                            Leasing Partner
                        </label>
                        <select name="leasing" id="leasing" required
                            style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #4a5568; outline: none; transition: 0.3s; cursor: pointer;">
                            <option value="" disabled selected>Pilih Leasing</option>
                            @foreach(['Suzuki Finance','BCA Finance','KKB BCA','Mandiri Tunas Finance','KKB MANDIRI','BSI','Mandiri Utama Finance','Indomobil Finance','Adira Finance','BNI Finance','MAYBANK','Oto Multiartha Finance','NIAGA Finance','Clipan Finance','Lain - Lain'] as $l)
                                <option value="{{ $l }}">{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; color: #2d3748; margin-bottom: 8px; font-size: 13px; text-transform: uppercase;">
                            Tahun
                        </label>
                        <input type="number" name="tahun" id="tahun" placeholder="Contoh: 2024"
                            value="{{ date('Y') }}" required
                            style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #4a5568; outline: none; transition: 0.3s;">
                    </div>
                </div>

                <div style="margin: 25px 0 15px 0; border-bottom: 2px dashed #edf2f7;"></div>

                <label style="display: block; font-weight: 800; color: #3182ce; margin-bottom: 15px; font-size: 14px; text-transform: uppercase; text-align: center;">
                    Realisasi PO Bulanan
                </label>

                @php
                    $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
                @endphp

                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
                    @foreach ($months as $m)
                        <div style="background: #ebf8ff; padding: 10px; border-radius: 12px; border: 1px solid #bee3f8;">
                            <label style="display: block; font-weight: 700; color: #2b6cb0; margin-bottom: 5px; font-size: 11px; text-align: center;">
                                {{ strtoupper($m) }}
                            </label>
                            <input type="number" name="{{ $m }}" value="0" min="0"
                                style="width: 100%; padding: 8px; border: 1px solid #90cdf4; border-radius: 8px; font-size: 14px; text-align: center; color: #2d3748; outline: none;">
                        </div>
                    @endforeach
                </div>

                {{-- Action Buttons --}}
                <div style="margin-top: 35px; display: flex; gap: 15px;">
                    <a href="{{ route('leasing.aktual-po.index') }}"
                        style="flex: 1; padding: 14px; background: #edf2f7; color: #4a5568; text-align: center; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px; transition: 0.3s;"
                        onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#edf2f7'">
                        Batal
                    </a>
                    <button type="button" onclick="confirmSubmit()"
                        style="flex: 2; padding: 14px; background: #1a202c; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.2);"
                        onmouseover="this.style.background='#2d3748'; this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.background='#1a202c'; this.style.transform='translateY(0)'">
                        Simpan Data PO
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SweetAlert2 & Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSubmit() {
            const leasing = document.getElementById('leasing').value;
            const tahun = document.getElementById('tahun').value;

            if (!leasing || !tahun) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Leasing Partner dan Tahun wajib diisi!',
                    confirmButtonColor: '#3182ce'
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: "Simpan data aktual PO untuk " + leasing + " tahun " + tahun + "?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1a202c',
                cancelButtonColor: '#cbd5e0',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Cek Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('aktualPoForm').submit();
                }
            });
        }
    </script>

    <style>
        input:focus,
        select:focus {
            border-color: #3182ce !important;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }
    </style>
@endsection