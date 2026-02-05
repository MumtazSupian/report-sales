<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Evaluasi Wiraniaga</title>
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
            box-shadow: 0 3px 10px rgba(0, 0, 0, .08);
            margin-bottom: 30px;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
        }

        .card-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, .25);
            border-color: #0d6efd;
        }

        hr {
            margin: 30px 0;
        }

        .btn {
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="excel-header">
        Tambah Evaluasi Wiraniaga
    </div>

    <div class="container">

        <div class="card">
            <div class="card-body">

                <h4 class="mb-4 fw-semibold">Form Input Evaluasi</h4>

                <form method="POST" action="{{ route('evaluasi.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sales Head</label>
                            <input type="text" name="nama_sales_head" class="form-control"
                                placeholder="Masukkan nama sales head">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Sales</label>
                            <input type="text" name="nama_sales" class="form-control"
                                placeholder="Masukkan nama sales">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal Evaluasi</label>
                            <input type="date" name="tanggal_evaluasi" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Grading</label>
                            <input type="text" name="grading" class="form-control" placeholder="Contoh:">
                        </div>
                    </div>

                    <hr>

                    <h5 class="section-title">📊 Nilai Bulanan</h5>

                    <div class="row">
                        @foreach (['jan', 'feb', 'mar', 'apr', 'mei', 'jun'] as $m)
                            <div class="col-md-2 mb-3">
                                <label class="form-label">{{ strtoupper($m) }}</label>
                                <input type="number" name="{{ $m }}"
                                    class="form-control text-end">
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Evaluasi</label>
                        <textarea name="evaluasi" class="form-control" rows="4" placeholder="Tulis hasil evaluasi..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" class="form-control">
                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('evaluasi.index') }}" class="btn btn-secondary">
                            ← Kembali
                        </a>

                        <button class="btn btn-primary shadow-sm">
                            💾 Simpan Data
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

</body>
</html>
