@extends('layouts.app')

@section('title', 'Main Dashboard')

@section('content')
    <div class="main-content" style="padding: 20px; background: #001f3f; min-height: 100vh; color: white;">

        <div style="margin-bottom: 30px;">
            <h2 style="font-weight: 800; text-transform: uppercase; letter-spacing: 1px; text-align: center; padding: 10px;">
                DASHBOARD PERFORMANCE</h2>
        </div>

        {{-- 1. TABLE SALES PERFORMANCE --}}
        <div style="background: white; border-radius: 8px; padding: 15px; margin-bottom: 25px; overflow-x: auto;">
            {{-- Judul otomatis berubah sesuai bulan dari Controller --}}
            <h4 style="color: #0d47a1; margin-bottom: 10px; font-weight: bold;">
                📊 SALES PERFORMANCE (N) {{ strtoupper($bulan) }} 2026
            </h4>
            <table style="width:100%; border-collapse: collapse; color: black; font-size: 11px; text-align: center;">
                <thead style="background: #1e40af; color: white;">
                    <tr>
                        <th rowspan="2" style="border: 1px solid #000; padding: 10px; width: 150px;">MODEL</th>
                        <th colspan="4" style="border: 1px solid #000;">Bulan Berjalan ({{ strtoupper($bulan) }})</th>
                        <th colspan="3" style="border: 1px solid #000;">RASIO</th>
                        <th colspan="3" style="border: 1px solid #000;">KPI Year-To-Date (YTD)</th>
                        <th colspan="2" style="border: 1px solid #000;">SALES PLAN (N+1)</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #000;">TRG RKA</th>
                        <th style="border: 1px solid #000;">ACT DO</th>
                        <th style="border: 1px solid #000;">ACT SPK</th>
                        <th style="border: 1px solid #000;">ACT INQ</th>
                        <th style="border: 1px solid #000;">INQ to DO</th>
                        <th style="border: 1px solid #000;">INQ to SPK</th>
                        <th style="border: 1px solid #000;">SPK to DO</th>
                        <th style="border: 1px solid #000;">TRG RKA</th>
                        <th style="border: 1px solid #000;">ACT DO</th>
                        <th style="border: 1px solid #000;">+/-</th>
                        <th style="border: 1px solid #000;">RKA</th>
                        <th style="border: 1px solid #000;">ADJ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($performance as $item)
                        <tr>
                            <td style="border: 1px solid #000; background: yellow; font-weight: bold; text-align: left; padding: 5px;">
                                {{ $item->mobil_type }}
                            </td>
                            {{-- Mengambil data kolom target sesuai bulan berjalan --}}
                            <td style="border: 1px solid #000;">{{ $item->$bulan }}</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0%</td>
                            <td style="border: 1px solid #000;">0%</td>
                            <td style="border: 1px solid #000;">0%</td>
                            <td style="border: 1px solid #000;">{{ $item->jan + $item->feb + $item->mar }}</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">{{ $item->apr }}</td>
                            <td style="border: 1px solid #000;"></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot style="background: #00b0f0; font-weight: bold;">
                    <tr>
                        <td style="border: 1px solid #000; text-align: left; padding: 5px;">GRAND TOTAL</td>
                        <td style="border: 1px solid #000;">{{ $performance->sum($bulan) }}</td>
                        <td style="border: 1px solid #000;">0</td>
                        <td style="border: 1px solid #000;">0</td>
                        <td style="border: 1px solid #000;">0</td>
                        <td style="border: 1px solid #000;">0%</td>
                        <td style="border: 1px solid #000;">0%</td>
                        <td style="border: 1px solid #000;">0%</td>
                        <td style="border: 1px solid #000;">
                            {{ $performance->sum('jan') + $performance->sum('feb') + $performance->sum('mar') }}
                        </td>
                        <td style="border: 1px solid #000;">0</td>
                        <td style="border: 1px solid #000;">0</td>
                        <td style="border: 1px solid #000;">{{ $performance->sum('apr') }}</td>
                        <td style="border: 1px solid #000;">0</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            {{-- 2. TABLE PERFORMANCE SOI (Gabungan Target Inquiry & Target DO) --}}
            <div style="background: white; border-radius: 8px; padding: 15px; overflow-x: auto;">
                <h4 style="color: #0d47a1; margin-bottom: 10px; font-weight: bold;">🔍 PERFORMANCE SOI ({{ strtoupper($bulan) }})</h4>
                <table style="width:100%; border-collapse: collapse; color: black; font-size: 10px; text-align: center;">
                    <thead style="background: #1e40af; color: white;">
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px;">SOURCE OF INQUIRY</th>
                            <th style="border: 1px solid #000;">TRG INQ</th>
                            <th style="border: 1px solid #000;">ACT INQ</th>
                            <th style="border: 1px solid #000;">TRG DO</th>
                            <th style="border: 1px solid #000;">ACT DO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total_inq = 0; $total_do = 0; @endphp
                        @foreach ($soi_combined as $item)
                            <tr>
                                <td style="border: 1px solid #000; text-align: left; background: yellow; font-weight: bold; padding: 4px;">
                                    {{ $item->source_inquiry }}
                                </td>
                                <td style="border: 1px solid #000;">{{ $item->trg_inq }}</td>
                                <td style="border: 1px solid #000;">0</td>
                                <td style="border: 1px solid #000;">{{ $item->trg_do }}</td>
                                <td style="border: 1px solid #000;">0</td>
                            </tr>
                            @php
                                $total_inq += $item->trg_inq;
                                $total_do += $item->trg_do;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot style="background: #00b0f0; font-weight: bold;">
                        <tr>
                            <td style="border: 1px solid #000; text-align: left; padding: 4px;">GRAND TOTAL</td>
                            <td style="border: 1px solid #000;">{{ $total_inq }}</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">{{ $total_do }}</td>
                            <td style="border: 1px solid #000;">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

    <div class="welcome-card">
        <div class="welcome-header">
            <div class="welcome-icon">🏢</div>
            <h3>Dashboard Utama Suzuki</h3>
        </div>
        <p>
            Selamat datang di Sistem Manajemen Dealer Suzuki. Platform terpadu untuk mengelola seluruh aspek operasional dealer.
            Klik menu <b>RKA</b> untuk masuk ke modul Rencana Kerja & Anggaran.
        </p>

        <div class="quick-actions">
            <h3>Quick Actions</h3>
            <div class="actions-grid">
                <a href="{{ url('rka/dashboard') }}" class="action-btn">
                    <span class="action-btn-icon">📊</span> <span>Open RKA Module</span>
                </a>
                <a href="{{ url('activity/dashboard') }}" class="action-btn">
                    <span class="action-btn-icon">📅</span> <span>Activity Plan</span>
                </a>
            </div>
        </div>
    </div>
</div>
            {{-- 3. TABLE SALES FORCE PERFORMANCE --}}
            <div style="background: white; border-radius: 8px; padding: 15px; overflow-x: auto;">
                <h4 style="color: #0d47a1; margin-bottom: 10px; font-weight: bold;">👥 SALES FORCE PERFORMANCE ({{ strtoupper($bulan) }})</h4>
                <table style="width:100%; border-collapse: collapse; color: black; font-size: 10px; text-align: center;">
                    <thead style="background: #1e40af; color: white;">
                        <tr>
                            <th rowspan="2" style="border: 1px solid #000; padding: 5px;">GRADING</th>
                            <th colspan="3" style="border: 1px solid #000;">Bulan Berjalan (N)</th>
                            <th colspan="3" style="border: 1px solid #000;">KAPASITAS JUAL</th>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000;">TRG SF</th>
                            <th style="border: 1px solid #000;">ACT SF</th>
                            <th style="border: 1px solid #000;">ACT DO</th>
                            <th style="border: 1px solid #000;">TRG</th>
                            <th style="border: 1px solid #000;">ACT</th>
                            <th style="border: 1px solid #000;">GAP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesforce as $item)
                            <tr>
                                <td style="border: 1px solid #000; text-align: left; background: yellow; font-weight: bold; padding: 4px;">
                                    {{ $item->grading }}
                                </td>
                                <td style="border: 1px solid #000;">{{ $item->$bulan ?? 0 }}</td>
                                <td style="border: 1px solid #000;">0</td>
                                <td style="border: 1px solid #000;">0</td>
                                <td style="border: 1px solid #000;">0</td>
                                <td style="border: 1px solid #000;">0</td>
                                <td style="border: 1px solid #000;">0</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background: #00b0f0; font-weight: bold;">
                        <tr>
                            <td style="border: 1px solid #000; text-align: left; padding: 4px;">GRAND TOTAL</td>
                            <td style="border: 1px solid #000;">{{ $salesforce->sum($bulan) }}</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
