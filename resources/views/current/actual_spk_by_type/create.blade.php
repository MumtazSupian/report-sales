@extends('layouts.app')

@section('title', 'Tambah Actual SPK By Type')

@section('content')
    <div style="padding: 40px 20px; display: flex; flex-direction: column; align-items: center; min-height: 100vh;">

        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-weight:800; color:#fff; letter-spacing:1px; text-transform:uppercase; margin:0;">
                TAMBAH ACTUAL SPK BY TYPE
            </h2>
            <div style="width: 50px; height: 4px; background: #3182ce; margin: 10px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; font-size: 14px;">Input data baru aktual surat pemesanan kendaraan tipe kendaraan</p>
        </div>

        <div
            style="background: white; width: 100%; max-width: 700px; padding: 35px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <form id="actualSpkForm" action="{{ route('current.actual-spk-by-type.store') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 10px;">
                    <div>
                        <label
                            style="display: block; font-weight: 700; color: #2d3748; margin-bottom: 8px; font-size: 13px; text-transform: uppercase;">
                            Tipe Mobil
                        </label>
                        <select name="mobil_type" id="mobil_type"
                            style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #4a5568; outline: none; transition: 0.3s; cursor: pointer;">
                            <option value="" disabled selected>Pilih Tipe Mobil</option>
                            @foreach (['NEW CARRY', 'APV', 'ERTIGA', 'XL7', 'SPRESO', 'BALENO', 'GRAND VITARA', 'JIMNY 3D', 'JIMNY 5D', 'FRONX'] as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label
                            style="display: block; font-weight: 700; color: #2d3748; margin-bottom: 8px; font-size: 13px; text-transform: uppercase;">
                            Tahun
                        </label>
                        <input type="number" name="tahun" id="tahun" placeholder="Masukkan Tahun"
                            value="{{ date('Y') }}"
                            style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #4a5568; outline: none; transition: 0.3s;">
                    </div>
                </div>

                <div style="margin: 25px 0 15px 0; border-bottom: 2px dashed #edf2f7;"></div>

                <label
                    style="display: block; font-weight: 800; color: #3182ce; margin-bottom: 15px; font-size: 14px; text-transform: uppercase; text-align: center;">
                    Data Aktual Per Bulan
                </label>

                @php
                    $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
                @endphp

                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
                    @foreach ($months as $m)
                        <div style="background: #f7fafc; padding: 10px; border-radius: 12px; border: 1px solid #edf2f7;">
                            <label
                                style="display: block; font-weight: 700; color: #718096; margin-bottom: 5px; font-size: 11px; text-align: center;">
                                {{ strtoupper($m) }}
                            </label>
                            <input type="number" name="{{ $m }}" value="0" min="0"
                                style="width: 100%; padding: 8px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 14px; text-align: center; color: #2d3748; outline: none;">
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 35px; display: flex; gap: 15px;">
                    <a href="{{ route('current.actual-spk-by-type.index') }}"
                        style="flex: 1; padding: 14px; background: #edf2f7; color: #4a5568; text-align: center; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px; transition: 0.3s;"
                        onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#edf2f7'">
                        Batal
                    </a>
                    <button type="button" onclick="confirmSubmit()"
                        style="flex: 2; padding: 14px; background: #1e88e5; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 12px rgba(30, 136, 229, 0.3);"
                        onmouseover="this.style.background='#1565c0'; this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.background='#1e88e5'; this.style.transform='translateY(0)'">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSubmit() {
            const mobilType = document.getElementById('mobil_type').value;
            const tahun = document.getElementById('tahun').value;

            if (!mobilType || !tahun) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tipe Mobil dan Tahun wajib diisi!',
                    confirmButtonColor: '#3182ce',
                    customClass: {
                        popup: 'rounded-4'
                    }
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: "Apakah Anda yakin data SPK yang dimasukkan sudah benar?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1e88e5',
                cancelButtonColor: '#cbd5e0',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Cek Kembali',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('actualSpkForm').submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-4'
                }
            });
        @endif
    </script>

    <style>
        input:focus,
        select:focus {
            border-color: #3182ce !important;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }
    </style>
@endsection
