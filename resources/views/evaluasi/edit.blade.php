<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Evaluasi Wiraniaga</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .excel-header {
            background: linear-gradient(90deg, #ffc107, #ffda6a);
            color: #333;
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
            box-shadow: 0 0 0 0.15rem rgba(255,193,7,.35);
            border-color: #ffc107;
        }

        .section-title {
            font-weight: 600;
            color: #0d6efd;
            margin-top: 10px;
        }

        hr {
            margin: 25px 0;
        }

        .btn {
            border-radius: 8px;
            padding: 8px 18px;
            font-weight: 500;
        }
    </style>
</head>

<body>

<div class="excel-header">
    ✏️ Edit Evaluasi Wiraniaga
</div>

<div class="container">

    <div class="card">
        <div class="card-body">

            <h4 class="mb-4 fw-semibold">Form Edit Data</h4>

            <form method="POST" action="{{ route('evaluasi.update', $row->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Sales Head</label>
                        <input type="text"
                               class="form-control"
                               name="nama_sales_head"
                               value="{{ $row->nama_sales_head }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Sales</label>
                        <input type="text"
                               class="form-control"
                               name="nama_sales"
                               value="{{ $row->nama_sales }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date"
                               class="form-control"
                               name="tanggal_masuk"
                               value="{{ $row->tanggal_masuk }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Evaluasi</label>
                        <input type="date"
                               class="form-control"
                               name="tanggal_evaluasi"
                               value="{{ $row->tanggal_evaluasi }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Grading</label>
                        <select name="grading" class="form-control">
                            <option value="A" {{ $row->grading == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ $row->grading == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ $row->grading == 'C' ? 'selected' : '' }}>C</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <hr>
                        <h5 class="section-title">📊 Nilai Bulanan</h5>
                    </div>

                    @foreach (['jan', 'feb', 'mar', 'apr', 'mei', 'jun'] as $m)
                        <div class="col-md-2">
                            <label class="form-label">{{ strtoupper($m) }}</label>
                            <input type="number"
                                   class="form-control text-end"
                                   name="{{ $m }}"
                                   value="{{ $row->$m }}">
                        </div>
                    @endforeach

                    <div class="col-md-6">
                        <label class="form-label">Evaluasi</label>
                        <textarea class="form-control"
                                  rows="4"
                                  name="evaluasi">{{ $row->evaluasi }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date"
                               class="form-control"
                               name="tanggal_keluar"
                               value="{{ $row->tanggal_keluar }}">
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-between">

                    <a href="{{ route('evaluasi.index') }}"
                       class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-warning text-dark shadow-sm">
                        💾 Update Data
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>
