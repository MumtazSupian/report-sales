<h2 style="text-align: center;">LAPORAN AKTUAL REJECT</h2>
<table border="1" width="100%" style="border-collapse: collapse; font-size: 10px;">
    <thead>
        <tr style="background: #eee;">
            <th>LEASING</th>
            <th>CABANG</th>
            <th>TAHUN</th>
            @foreach(['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'] as $m)
                <th>{{ strtoupper($m) }}</th>
            @endforeach
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $row->leasing }}</td>
            <td>{{ $row->cabang }}</td>
            <td>{{ $row->tahun }}</td>
            @foreach(['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'] as $m)
                <td>{{ $row->$m }}</td>
            @endforeach
            <td>{{ $row->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
