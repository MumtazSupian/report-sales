@extends('layouts.app')

@section('content')
<div style="padding: 20px 40px; font-family: 'Segoe UI', sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="color: white; margin: 0; font-weight: 700; letter-spacing: 1px;">TARGET SALESFORCE</h2>
            <p style="color: #cbd5e0; margin: 5px 0 0 0; font-size: 14px;">Manajemen target produktivitas berdasarkan grading sales</p>
        </div>

        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="{{ url('/rka/dashboard') }}"
                style="padding: 10px 18px; background: rgba(255,255,255,0.1); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 13px; border: 1px solid rgba(255,255,255,0.2); transition: 0.3s;">
                ← Dashboard
            </a>
            <a href="{{ route('rka.target-salesforces.create') }}"
                style="padding: 10px 20px; background: #3182ce; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 13px; box-shadow: 0 4px 12px rgba(49, 130, 206, 0.3); transition: 0.3s;">
                + TAMBAH DATA
            </a>
        </div>
    </div>

    @php
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $grandTotals = [];
        foreach ($months as $m) { $grandTotals[$m] = $data->sum($m); }
        $grandTotalAll = $data->sum('total');
    @endphp

    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 15px 35px rgba(0,0,0,0.3); overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 13px; min-width: 1100px;">
            <thead>
                <tr style="background: #2d3748; color: white;">
                    <th style="padding: 15px; text-align: left; border-radius: 10px 0 0 0;">GRADING</th>
                    <th style="padding: 15px; text-align: center;">TAHUN</th>
                    @foreach($months as $m)
                        <th style="padding: 15px; text-align: center;">{{ strtoupper($m) }}</th>
                    @endforeach
                    <th style="padding: 15px; text-align: center; background: #1a202c;">TOTAL</th>
                    <th style="padding: 15px; text-align: center; border-radius: 0 10px 0 0;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr style="border-bottom: 1px solid #edf2f7; transition: 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 12px 15px;">
                            <span style="background: #edf2f7; color: #2d3748; padding: 4px 10px; border-radius: 6px; font-weight: 800; font-size: 11px;">
                                {{ strtoupper($row->grading) }}
                            </span>
                        </td>
                        <td style="padding: 12px 15px; text-align: center; color: #718096;">{{ $row->tahun }}</td>
                        @foreach($months as $m)
                            <td style="padding: 12px 5px; text-align: center; color: #4a5568;">{{ number_format($row->$m, 0, ',', '.') }}</td>
                        @endforeach
                        <td style="padding: 12px 15px; text-align: center; font-weight: 800; color: #2d3748; background: #f7fafc;">
                            {{ number_format($row->total, 0, ',', '.') }}
                        </td>
                        <td style="padding: 12px 15px; text-align: center;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <a href="{{ route('rka.target-salesforces.edit', $row->id) }}" 
                                   style="padding: 6px 12px; background: #ebf4ff; color: #3182ce; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 11px; border: 1px solid #bee3f8;">
                                   EDIT
                                </a>
                                <form action="{{ route('rka.target-salesforces.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data target ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            style="padding: 6px 12px; background: #fff5f5; color: #e53e3e; border: 1px solid #fed7d7; border-radius: 6px; font-weight: 700; font-size: 11px; cursor: pointer;">
                                        HAPUS
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background: #edf2f7; font-weight: 800; color: #2d3748;">
                    <td colspan="2" style="padding: 15px; text-align: right; border-radius: 0 0 0 10px;">GRAND TOTAL</td>
                    @foreach ($months as $m)
                        <td style="padding: 15px; text-align: center;">{{ number_format($grandTotals[$m], 0, ',', '.') }}</td>
                    @endforeach
                    <td style="padding: 15px; text-align: center; background: #e2e8f0;">{{ number_format($grandTotalAll, 0, ',', '.') }}</td>
                    <td style="padding: 15px; text-align: center; border-radius: 0 0 10px 0;">-</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection