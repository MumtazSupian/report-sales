<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Evaluasi Wiraniaga</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .excel-header {
            background: linear-gradient(90deg, #0d6efd, #0aa2c0);
            color: white;
            padding: 18px 24px;
            font-weight: 600;
            font-size: 22px;
            box-shadow: 0 3px 10px rgba(0,0,0,.08);
            margin-bottom: 30px;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0,0,0,.06);
        }

        table th {
            background: #0d6efd;
            color: white;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            font-size: 14px;
        }

        table td {
            vertical-align: middle;
            white-space: nowrap;
            font-size: 14px;
        }

        tbody tr:hover {
            background-color: #f1f7ff;
        }

        tfoot td {
            background: #e9f2ff;
            font-weight: bold;
            font-size: 15px;
        }

        .badge-grading {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="excel-header">
        📊 EVALUASI WIRANIAGA
    </div>

    <div class="container-fluid">

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-0 fw-semibold">Data Evaluasi</h4>
                        <small class="text-muted">Monitoring kinerja wiraniaga</small>
                    </div>

                    <a href="{{ route('evaluasi.create') }}"
                       class="btn btn-primary shadow-sm">
                        ➕ Tambah Data
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sales Head</th>
                                <th>Nama Sales</th>
                                <th>Tgl Masuk</th>
                                <th>Tgl Evaluasi</th>
                                <th>Grading</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>Mei</th>
                                <th>Jun</th>
                                <th>Total</th>
                                <th>Evaluasi</th>
                                <th>Tgl Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $i => $d)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td>{{ $d->nama_sales_head }}</td>
                                    <td>{{ $d->nama_sales }}</td>
                                    <td>{{ $d->tanggal_masuk }}</td>
                                    <td>{{ $d->tanggal_evaluasi }}</td>

                                    <!-- GRADING BADGE -->
                                    <td class="text-center">
                                        <span class="badge
                                            @if($d->grading == 'A') bg-success
                                            @elseif($d->grading == 'B') bg-primary
                                            @elseif($d->grading == 'C') bg-warning text-dark
                                            @else bg-danger
                                            @endif
                                            badge-grading">
                                            {{ $d->grading }}
                                        </span>
                                    </td>

                                    <td class="text-end">{{ $d->jan }}</td>
                                    <td class="text-end">{{ $d->feb }}</td>
                                    <td class="text-end">{{ $d->mar }}</td>
                                    <td class="text-end">{{ $d->apr }}</td>
                                    <td class="text-end">{{ $d->mei }}</td>
                                    <td class="text-end">{{ $d->jun }}</td>

                                    <td class="text-end fw-bold text-primary">
                                        {{ $d->total }}
                                    </td>

                                    <td>{{ $d->evaluasi }}</td>
                                    <td>{{ $d->tanggal_keluar }}</td>

                                    <td class="text-center">

                                        <a href="{{ route('evaluasi.edit', $d->id) }}"
                                           class="btn btn-sm btn-warning shadow-sm">
                                            ✏️
                                        </a>

                                        <form action="{{ route('evaluasi.destroy', $d->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Hapus data ini?')"
                                                    class="btn btn-sm btn-danger shadow-sm">
                                                🗑️
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="12" class="text-end fw-bold">
                                     GRAND TOTAL
                                </td>
                                <td class="text-end text-primary fw-bold">
                                    {{ $grandTotal }}
                                </td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>

                    </table>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
