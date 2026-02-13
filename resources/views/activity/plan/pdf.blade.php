<style>
    body {
        font-family: sans-serif;
        font-size: 7px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #0d47a1;
        color: white;
        border: 1px solid black;
        padding: 3px;
        text-align: center;
    }

    td {
        border: 1px solid black;
        padding: 2px;
        text-align: center;
        vertical-align: middle;
    }

    .bg-footer {
        background-color: #0d47a1;
        color: white;
        font-weight: bold;
    }

    .text-left {
        text-align: left;
        padding-left: 3px;
    }
</style>

<table>
    <thead>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">CABANG</th>
            <th rowspan="2">JENIS</th>
            <th rowspan="2">ACTIVITY</th>
            <th rowspan="2">LOKASI</th>
            <th colspan="2">UPLOAD KONTEN</th>
            <th colspan="2">WAKTU</th>
            <th rowspan="2">PIC</th>
            <th rowspan="2">JML SALES</th>
            <th colspan="3">TARGET</th>
            <th colspan="4">ACTUAL</th>
            <th rowspan="2">TOTAL COST</th>
            <th rowspan="2">COST/P</th>
            <th rowspan="2">COST/SPK</th>
            <th rowspan="2">COST/DO</th>
            <th rowspan="2">KETERANGAN</th>
        </tr>
        <tr>
            <th>Jenis</th>
            <th>Type</th>
            <th>Tgl</th>
            <th>Jam</th>
            <th>P</th>
            <th>HP</th>
            <th>SPK</th>
            <th>P</th>
            <th>HP</th>
            <th>SPK</th>
            <th>DO</th>
        </tr>
    </thead>
    <tbody>
        @php
            $gtSales = 0;
            $gtTP = 0;
            $gtTHP = 0;
            $gtTSPK = 0;
            $gtAP = 0;
            $gtAHP = 0;
            $gtASPK = 0;
            $gtADO = 0;
            $gtCost = 0;
            $gtCP = 0;
            $gtCSPK = 0;
            $gtCDO = 0;
        @endphp

        @foreach ($data as $row)
            @php
                $sales = (int) ($row->jml_sales_shift ?? 0);
                $gtSales += $sales;
                $gtTP += $row->target_p;
                $gtTHP += $row->target_hp;
                $gtTSPK += $row->target_spk;
                $gtAP += $row->actual_p;
                $gtAHP += $row->actual_hp;
                $gtASPK += $row->actual_spk;
                $gtADO += $row->actual_do;
                $gtCost += $row->total_cost;
                $gtCP += $row->cost_p;
                $gtCSPK += $row->cost_spk;
                $gtCDO += $row->cost_do;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->cabang }}</td>
                <td>{{ $row->jenis_activity }}</td>
                <td class="text-left">{{ $row->activity }}</td>
                <td>{{ $row->platform_lokasi }}</td>
                <td>{{ $row->jenis_unit }}</td>
                <td>{{ $row->type_unit }}</td>
                <td>{{ $row->tanggal }}</td>
                <td>{{ $row->jam }}</td>
                <td>{{ $row->pic }}</td>
                <td>{{ $sales }}</td>
                <td>{{ $row->target_p }}</td>
                <td>{{ $row->target_hp }}</td>
                <td>{{ $row->target_spk }}</td>
                <td>{{ $row->actual_p }}</td>
                <td>{{ $row->actual_hp }}</td>
                <td>{{ $row->actual_spk }}</td>
                <td>{{ $row->actual_do }}</td>
                <td>Rp{{ number_format($row->total_cost, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($row->cost_p, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($row->cost_spk, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($row->cost_do, 0, ',', '.') }}</td>
                <td class="text-left">{{ $row->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="bg-footer">
            <td colspan="10">GRAND TOTAL</td>
            <td>{{ $gtSales }}</td>
            <td>{{ $gtTP }}</td>
            <td>{{ $gtTHP }}</td>
            <td>{{ $gtTSPK }}</td>
            <td>{{ $gtAP }}</td>
            <td>{{ $gtAHP }}</td>
            <td>{{ $gtASPK }}</td>
            <td>{{ $gtADO }}</td>
            <td>Rp{{ number_format($gtCost, 0, ',', '.') }}</td>
            <td>Rp{{ number_format($gtCP, 0, ',', '.') }}</td>
            <td>Rp{{ number_format($gtCSPK, 0, ',', '.') }}</td>
            <td>Rp{{ number_format($gtCDO, 0, ',', '.') }}</td>
            <td>-</td>
        </tr>
    </tfoot>
</table>
