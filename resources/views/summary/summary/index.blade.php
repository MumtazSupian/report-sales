<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Summary Improvement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
        }

        .badge-v {
            background-color: #198754;
        }

        .badge-x {
            background-color: #dc3545;
        }

        .card {
            border-radius: 14px;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <span class="navbar-brand fw-bold">
                📊 Summary Improvement
            </span>
        </div>
    </nav>

    <div class="container pb-5">

        {{-- TOP ACTION BAR --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ url('/summary/dashboard') }}" class="btn btn-outline-secondary">
                ← Kembali ke Dashboard
            </a>

            <a href="{{ route('summary.summary.create') }}" class="btn btn-primary fw-semibold">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>

        {{-- CARD --}}
        <div class="card shadow border-0">
            <div class="card-body">

                {{-- ALERT --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- TABLE --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th width="20%">Operasional</th>
                                <th>Plan Pelaksanaan</th>
                                <th>Aktual Pelaksanaan</th>
                                <th width="8%">Do / Don't</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($summaries as $s)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $s->operasional }}
                                    </td>

                                    <td>
                                        {{ $s->plan_perbaikan }}
                                    </td>

                                    <td>
                                        {{ $s->aktual_perbaikan }}
                                    </td>

                                    <td class="text-center">
                                        @if ($s->do_dont == 'V')
                                            <span class="badge badge-v px-3 py-2">✔ Do</span>
                                        @elseif ($s->do_dont == 'X')
                                            <span class="badge badge-x px-3 py-2">✖ Don't</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('summary.summary.edit', $s->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('summary.summary.destroy', $s->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Data belum tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
