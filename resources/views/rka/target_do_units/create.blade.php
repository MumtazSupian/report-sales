@extends('layouts.app')

@section('content')
<div style="padding: 20px 40px; font-family: 'Segoe UI', sans-serif;">
    
    <div style="margin-bottom: 25px;">
        <h2 style="color: white; margin: 0; font-weight: 700; letter-spacing: 1px;">TAMBAH TARGET DO UNIT</h2>
        <p style="color: #cbd5e0; margin: 5px 0 0 0; font-size: 14px;">Input rencana target penjualan baru berdasarkan tipe mobil</p>
    </div>

    <div style="max-width: 1300px; background: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); padding: 40px; color: #333;">
        <form action="{{ route('rka.target-do-units.store') }}" method="POST">
            @csrf

            <div style="display: grid; gap: 30px;">
                <div style="border-left: 5px solid #3182ce; padding: 20px; background: #f7fafc; border-radius: 0 12px 12px 0;">
                    <h3 style="color: #2b6cb0; margin-top: 0; font-size: 16px; margin-bottom: 20px; font-weight: 800; text-transform: uppercase;">A. Informasi Kendaraan</h3>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; margin-bottom: 8px;">Mobil Type</label>
                            <select name="mobil_type" style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 14px;">
                                @foreach(['NEW CARRY','APV','ERTIGA','XL7','SPRESO','BALENO','GRAND VITARA','JIMNY 3D','JIMNY 5D','FRONX'] as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; margin-bottom: 8px;">Tahun</label>
                            <input type="number" name="tahun" placeholder="2024" style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 14px;">
                        </div>
                    </div>
                </div>

                <div style="border-left: 5px solid #28a745; padding: 25px; background: #f0fff4; border-radius: 0 12px 12px 0;">
                    <h3 style="color: #2f855a; margin-top: 0; font-size: 16px; margin-bottom: 20px; font-weight: 800; text-transform: uppercase;">B. Target Unit Per Bulan</h3>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
                        @foreach(['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'] as $m)
                            <div>
                                <label style="display: block; font-weight: 800; font-size: 12px; color: #4a5568; margin-bottom: 5px;">{{ strtoupper($m) }}</label>
                                <input type="number" name="{{ $m }}" value="0" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 14px;">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 15px; border-top: 2px solid #f7fafc; padding-top: 20px;">
                    <a href="{{ route('rka.target-do-units.index') }}" style="padding: 12px 25px; background: #e2e8f0; color: #4a5568; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px;">Batal</a>
                    <button type="submit" style="padding: 12px 40px; background: #1a202c; color: white; border-radius: 10px; border: none; font-weight: 700; font-size: 14px; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">SIMPAN DATA</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection