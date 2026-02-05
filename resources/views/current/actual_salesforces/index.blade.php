<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
    <a href="{{ route('current.actual-salesforces.create') }}"
        style="
            padding: 8px 15px;
            background: black;
            color: white;
            text-decoration: none;
            border-radius: 6px;
       ">
        + Tambah Data
    </a>

    <a href="{{ url('/current/dashboard') }}"
        style="
            padding: 8px 15px;
            background: gray;
            color: white;
            text-decoration: none;
            border-radius: 6px;
       ">
        Kembali ke Dashboard
    </a>
</div>

@php
    $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
@endphp

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 14px;
        background: white;
    }

    th {
        background: #111;
        color: white;
        padding: 10px;
        text-align: center;
    }

    td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background: #f5f5f5;
    }

    .btn-edit {
        padding: 5px 10px;
        background: #2563eb;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 13px;
    }

    .btn-delete {
        padding: 5px 10px;
        background: #dc2626;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 13px;
    }

    form {
        display: inline;
    }
</style>

<h2 style="font-family: Arial; margin-bottom: 15px;">Actual Salesforces</h2>

<table>
    <tr>
        <th>Grading</th>
        <th>Tahun</th>
        @foreach ($months as $m)
            <th>{{ strtoupper($m) }}</th>
        @endforeach
        <th>Total</th>
        <th>Aksi</th>
    </tr>

    @php
        $grandTotals = [];
        foreach ($months as $m) {
            $grandTotals[$m] = $data->sum($m);
        }
        $grandTotalAll = $data->sum('total');
    @endphp

    @foreach ($data as $row)
        <tr>
            <td>{{ $row->grading }}</td>
            <td>{{ $row->tahun }}</td>

            @foreach ($months as $m)
                <td>{{ $row->$m }}</td>
            @endforeach

            <td><b>{{ $row->total }}</b></td>

            <td>
                <a href="{{ route('current.actual-salesforces.edit', $row->id) }}" class="btn-edit">Edit</a>

                <form action="{{ route('current.actual-salesforces.destroy', $row->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach

    <!-- Baris Grand Total -->
    <tr style="background:#e5e7eb; font-weight:bold;">
        <td colspan="2">GRAND TOTAL</td>
        @foreach ($months as $m)
            <td>{{ $grandTotals[$m] }}</td>
        @endforeach
        <td>{{ $grandTotalAll }}</td>
        <td>-</td>
    </tr>
</table>
