@extends('layouts.app')

@section('title', 'Main Dashboard')

@section('content')
    <div class="main-content" style="padding: 20px; background: #001f3f; min-height: 100vh; color: white;">

        <div
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid rgba(255,255,255,0.1); padding-bottom: 15px;">
            <h2 style="font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin: 0;">
                DASHBOARD PERFORMANCE
            </h2>

            {{-- DROPDOWN FILTER BULAN --}}
            <form action="{{ url()->current() }}" method="GET" id="filterForm"
                style="display: flex; align-items: center; gap: 10px;">
                <label style="font-weight: bold; font-size: 14px;">PERIODE DATA:</label>
                <select name="filter_bulan" onchange="document.getElementById('filterForm').submit()"
                    style="padding: 8px 15px; border-radius: 5px; border: none; font-weight: bold; color: #001f3f; cursor: pointer; outline: none;">
                    @foreach ($bulan_list as $angka => $nama)
                        <option value="{{ $nama }}" {{ $bulan == $nama ? 'selected' : '' }}>
                            {{ strtoupper($nama) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- 1. TABLE SALES PERFORMANCE --}}
        <div
            style="background: white; border-radius: 8px; padding: 15px; margin-bottom: 25px; overflow-x: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
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
                {{-- 1. TABLE SALES PERFORMANCE --}}
                <tbody>
                    @foreach ($performance as $item)
                        <tr>
                            <td
                                style="border: 1px solid #000; background: #ffff00; font-weight: bold; text-align: left; padding: 5px;">
                                {{ $item->mobil_type }}
                            </td>
                            <td style="border: 1px solid #000; font-weight: bold;">{{ $item->$bulan }}</td>
                            <td style="border: 1px solid #000;">{{ $item->act_do }}</td>
                            <td style="border: 1px solid #000;">{{ $item->act_spk }}</td>
                            <td style="border: 1px solid #000;">{{ $item->act_inq }}</td>

                            {{-- Rasio dikosongkan dulu --}}
                            <td style="border: 1px solid #000;">-</td>
                            <td style="border: 1px solid #000;">-</td>
                            <td style="border: 1px solid #000;">-</td>

                            <td style="border: 1px solid #000; background: #f0f0f0;">{{ $item->ytd_target }}</td>
                            <td style="border: 1px solid #000;">{{ $item->ytd_act_do }}</td>
                            <td style="border: 1px solid #000;">{{ $item->ytd_act_do - $item->ytd_target }}</td>
                            <td style="border: 1px solid #000;">{{ $item->plan_rka_next }}</td>
                            <td style="border: 1px solid #000;"></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot style="background: #00b0f0; font-weight: bold;">
                    <tr>
                        <td style="border: 1px solid #000; text-align: left; padding: 5px;">GRAND TOTAL</td>
                        <td style="border: 1px solid #000;">{{ $performance->sum($bulan) }}</td>
                        <td style="border: 1px solid #000;">{{ $performance->sum('act_do') }}</td>
                        <td style="border: 1px solid #000;">{{ $performance->sum('act_spk') }}</td>
                        <td style="border: 1px solid #000;">{{ $performance->sum('act_inq') }}</td>
                        <td colspan="3" style="border: 1px solid #000;">AVG RATIO CALCULATED</td>
                        <td style="border: 1px solid #000;">{{ $performance->sum('ytd_target') }}</td>
                        <td style="border: 1px solid #000;">{{ $performance->sum('ytd_act_do') }}</td>
                        <td style="border: 1px solid #000;">
                            {{ $performance->sum('ytd_act_do') - $performance->sum('ytd_target') }}</td>
                        <td style="border: 1px solid #000;">{{ $performance->sum('plan_rka_next') }}</td>
                        <td style="border: 1px solid #000;">0</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            {{-- 2. TABLE PERFORMANCE SOI --}}
            <div
                style="background: white; border-radius: 8px; padding: 15px; overflow-x: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                <h4 style="color: #0d47a1; margin-bottom: 10px; font-weight: bold;">🔍 PERFORMANCE SOI
                    ({{ strtoupper($bulan) }})</h4>
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
                        @foreach ($soi_performance as $item)
                            @php
                                // Lookup Target Data from $soi_combined
                                $target = collect($soi_combined)->where('source_inquiry', $item->source_name)->first();
                            @endphp
                            <tr>
                                <td
                                    style="border: 1px solid #000; text-align: left; background: #ffff00; font-weight: bold; padding: 4px;">
                                    {{ $item->source_name }}
                                </td>
                                <td style="border: 1px solid #000;">{{ $target->trg_inq ?? 0 }}</td>
                                <td style="border: 1px solid #000;">{{ $item->act_inq }}</td>
                                <td style="border: 1px solid #000;">{{ $target->trg_do ?? 0 }}</td>
                                <td style="border: 1px solid #000;">{{ $item->act_do }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background: #00b0f0; font-weight: bold;">
                        <tr>
                            <td style="border: 1px solid #000; text-align: left; padding: 4px;">GRAND TOTAL</td>
                            {{-- Sum Targets from $soi_combined --}}
                            <td style="border: 1px solid #000;">{{ collect($soi_combined)->sum('trg_inq') }}</td>
                            {{-- Sum Actuals from $soi_performance --}}
                            <td style="border: 1px solid #000;">{{ collect($soi_performance)->sum('act_inq') }}</td>
                            
                            <td style="border: 1px solid #000;">{{ collect($soi_combined)->sum('trg_do') }}</td>
                            <td style="border: 1px solid #000;">{{ collect($soi_performance)->sum('act_do') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- 3. TABLE SALES FORCE PERFORMANCE --}}
            <div
                style="background: white; border-radius: 8px; padding: 15px; overflow-x: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                <h4 style="color: #0d47a1; margin-bottom: 10px; font-weight: bold;">👥 SALES FORCE PERFORMANCE
                    ({{ strtoupper($bulan) }})</h4>
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
                                <td
                                    style="border: 1px solid #000; text-align: left; background: #ffff00; font-weight: bold; padding: 4px;">
                                    {{ $item->grading }}
                                </td>
                                <td style="border: 1px solid #000;">{{ $item->trg_sf ?? 0 }}</td>
                                <td style="border: 1px solid #000;">{{ $item->act_sf }}</td>
                                <td style="border: 1px solid #000;">{{ $item->act_do }}</td>
                                <td style="border: 1px solid #000;">0</td>
                                <td style="border: 1px solid #000;">0</td>
                                <td style="border: 1px solid #000;">0</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background: #00b0f0; font-weight: bold;">
                        <tr>
                            <td style="border: 1px solid #000; text-align: left; padding: 4px;">GRAND TOTAL</td>
                            <td style="border: 1px solid #000;">{{ $salesforce->sum('trg_sf') }}</td>
                            <td style="border: 1px solid #000;">{{ $salesforce->sum('act_sf') }}</td>
                            <td style="border: 1px solid #000;">{{ $salesforce->sum('act_do') }}</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0</td>
                            <td style="border: 1px solid #000;">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- 4. TABLE PERFORMANCE LEASING --}}
            <div
                style="background: white; border-radius: 8px; padding: 15px; margin-top: 25px; overflow-x: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                <h4 style="color: #0d47a1; margin-bottom: 10px; font-weight: bold;">💳 PERFORMANCE LEASING
                    ({{ strtoupper($bulan) }})</h4>
                <table style="width:100%; border-collapse: collapse; color: black; font-size: 10px; text-align: center;">
                    <thead style="background: #1e40af; color: white;">
                        <tr>
                            <th rowspan="2" style="border: 1px solid #000; padding: 8px;">LEASING</th>
                            <th colspan="3" style="border: 1px solid #000;">Bulan Berjalan ({{ strtoupper($bulan) }})
                            </th>
                            <th colspan="3" style="border: 1px solid #000;">Year To Date (YTD)</th>
                            <th rowspan="2" style="border: 1px solid #000;">Credit Share</th>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000;">PO</th>
                            <th style="border: 1px solid #000;">REJECT</th>
                            <th style="border: 1px solid #000;">APL IN</th>
                            <th style="border: 1px solid #000;">PO</th>
                            <th style="border: 1px solid #000;">REJECT</th>
                            <th style="border: 1px solid #000;">APL IN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalYtdAll = collect($leasing_performance)->sum('ytd_po'); @endphp
                        @foreach ($leasing_performance as $l)
                            <tr>
                                <td
                                    style="border: 1px solid #000; text-align: left; background: #ffff00; font-weight: bold; padding: 4px;">
                                    {{ $l->nama }}</td>
                                <td style="border: 1px solid #000;">{{ $l->po }}</td>
                                <td style="border: 1px solid #000;">{{ $l->reject }}</td>
                                <td style="border: 1px solid #000;">{{ $l->aplin }}</td>
                                <td style="border: 1px solid #000; background: #f0f0f0;">{{ $l->ytd_po }}</td>
                                <td style="border: 1px solid #000; background: #f0f0f0;">{{ $l->ytd_reject }}</td>
                                <td style="border: 1px solid #000; background: #f0f0f0;">{{ $l->ytd_aplin }}</td>
                                <td style="border: 1px solid #000; font-weight: bold;">
                                    {{ $totalYtdAll > 0 ? round(($l->ytd_po / $totalYtdAll) * 100, 1) : 0 }}%
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background: #00b0f0; font-weight: bold;">
                        <tr>
                            <td style="border: 1px solid #000; text-align: left; padding: 4px;">GRAND TOTAL</td>
                            <td style="border: 1px solid #000;">{{ collect($leasing_performance)->sum('po') }}</td>
                            <td style="border: 1px solid #000;">{{ collect($leasing_performance)->sum('reject') }}</td>
                            <td style="border: 1px solid #000;">{{ collect($leasing_performance)->sum('aplin') }}</td>
                            <td style="border: 1px solid #000;">{{ collect($leasing_performance)->sum('ytd_po') }}</td>
                            <td style="border: 1px solid #000;">{{ collect($leasing_performance)->sum('ytd_reject') }}
                            </td>
                            <td style="border: 1px solid #000;">{{ collect($leasing_performance)->sum('ytd_aplin') }}</td>
                            <td style="border: 1px solid #000;">100%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
