@extends('layouts.app')

@section('content')
    <div style="padding: 40px 20px; display: flex; flex-direction: column; align-items: center; min-height: 100vh;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-weight:800; color:#fff; letter-spacing:1px; text-transform:uppercase; margin:0;">
                TAMBAH TARGET DO UNIT
            </h2>
            <div style="width: 50px; height: 4px; background: #3182ce; margin: 10px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; font-size: 14px;">Input rencana target penjualan baru berdasarkan tipe mobil</p>
        </div>

        <div style="background: white; width: 100%; max-width: 700px; padding: 35px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <form id="targetUnitForm" action="{{ route('rka.target-do-units.store') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 10px;">
                    <div>
                        <label style="display: block; font-weight: 700; color: #2d3748; margin-bottom: 8px; font-size: 13px; text-transform: uppercase;">Mobil Type</label>
                        <select name="mobil_type" id="mobil_type" required style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #4a5568;">
                            <option value="" disabled selected>Pilih Tipe Mobil</option>
                            @foreach(['NEW CARRY','APV','ERTIGA','XL7','SPRESO','BALENO','GRAND VITARA','JIMNY 3D','JIMNY 5D','FRONX'] as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; color: #2d3748; margin-bottom: 8px; font-size: 13px; text-transform: uppercase;">Tahun</label>
                        <input type="number" name="tahun" value="{{ date('Y') }}" required style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #4a5568;">
                    </div>
                </div>

                <div style="margin: 25px 0 15px 0; border-bottom: 2px dashed #edf2f7;"></div>
                <label style="display: block; font-weight: 800; color: #3182ce; margin-bottom: 15px; font-size: 14px; text-transform: uppercase; text-align: center;">Target Per Bulan</label>

                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
                    @foreach (['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'] as $m)
                        <div style="background: #f0f9ff; padding: 10px; border-radius: 12px; border: 1px solid #bee3f8;">
                            <label style="display: block; font-weight: 700; color: #2b6cb0; margin-bottom: 5px; font-size: 11px; text-align: center;">{{ strtoupper($m) }}</label>
                            <input type="number" name="{{ $m }}" value="0" min="0" style="width: 100%; padding: 8px; border: 1px solid #90cdf4; border-radius: 8px; font-size: 14px; text-align: center;">
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 35px; display: flex; gap: 15px;">
                    <a href="{{ route('rka.target-do-units.index') }}" style="flex: 1; padding: 14px; background: #edf2f7; color: #4a5568; text-align: center; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px;">Batal</a>
                    <button type="button" onclick="confirmSubmit()" style="flex: 2; padding: 14px; background: #1a202c; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSubmit() {
            const type = document.getElementById('mobil_type').value;
            if (!type) { Swal.fire('Error', 'Pilih Tipe Mobil!', 'error'); return; }
            Swal.fire({
                title: 'Simpan Target?',
                text: "Simpan target unit untuk tipe " + type + "?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3182ce',
                cancelButtonColor: '#e53e3e',
                confirmButtonText: 'Ya, Simpan!'
                cancelButtonText: 'Cek Kembali'
            }).then((result) => { if (result.isConfirmed) document.getElementById('targetUnitForm').submit(); });
        }
    </script>
@endsection