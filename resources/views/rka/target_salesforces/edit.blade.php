@extends('layouts.app')

@section('content')
<div style="padding: 20px 40px; font-family: 'Segoe UI', sans-serif;">
    
    <div style="margin-bottom: 25px;">
        <h2 style="color: white; margin: 0; font-weight: 700; letter-spacing: 1px;">EDIT TARGET SALESFORCE</h2>
        <p style="color: #cbd5e0; margin: 5px 0 0 0; font-size: 14px;">Perbarui standar target untuk grading {{ $row->grading }}</p>
    </div>

    <div style="max-width: 1300px; background: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); padding: 40px; color: #333;">
        <form action="{{ route('rka.target-salesforces.update', $row->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; gap: 30px;">
                <div style="border-left: 5px solid #3182ce; padding: 20px; background: #f7fafc; border-radius: 0 12px 12px 0;">
                    <h3 style="color: #2b6cb0; margin-top: 0; font-size: 16px; margin-bottom: 20px; font-weight: 800; text-transform: uppercase;">A. Klasifikasi Grading</h3>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; margin-bottom: 8px;">Grading Salesforce</label>
                            <select name="grading" style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 14px;">
                                @foreach(['Freelance','Trainee','Silver','Gold','Platinum'] as $g)
                                    <option value="{{ $g }}" {{ $row->grading == $g ? 'selected' : '' }}>{{ $g }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; margin-bottom: 8px;">Tahun</label>
                            <input type="number" name="tahun" value="{{ $row->tahun }}" style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 14px;">
                        </div>
                    </div>
                </div>

                <div style="border-left: 5px solid #e53e3e; padding: 25px; background: #fff5f5; border-radius: 0 12px 12px 0;">
                    <h3 style="color: #c53030; margin-top: 0; font-size: 16px; margin-bottom: 20px; font-weight: 800; text-transform: uppercase;">B. Update Target Bulanan</h3>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
                        @foreach(['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'] as $m)
                            <div>
                                <label style="display: block; font-weight: 800; font-size: 12px; color: #4a5568; margin-bottom: 5px;">{{ strtoupper($m) }}</label>
                                <input type="number" name="{{ $m }}" value="{{ $row->$m }}" step="0.1" style="width: 100%; padding: 10px; border: 1px solid #feb2b2; border-radius: 8px; font-size: 14px;">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 15px; border-top: 2px solid #f7fafc; padding-top: 20px;">
                    <a href="{{ route('rka.target-salesforces.index') }}" style="padding: 12px 25px; background: #e2e8f0; color: #4a5568; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px;">Batal</a>
                    <button type="submit" style="padding: 12px 40px; background: #2d3748; color: white; border-radius: 10px; border: none; font-weight: 700; font-size: 14px; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">UPDATE DATA</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection