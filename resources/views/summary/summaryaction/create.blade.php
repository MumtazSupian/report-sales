<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Action</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .card {
            border-radius: 14px;
        }

        .form-label {
            font-weight: 600;
        }

        textarea {
            resize: none;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <span class="navbar-brand fw-bold">
                🛠️ Summary Action Improvement
            </span>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Action Perbaikan
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('summary.summaryaction.store') }}" method="POST">
                            @csrf

                            {{-- OPERASIONAL --}}
                            <div class="mb-4">
                                <label class="form-label">Operasional</label>
                                <select name="operasional" class="form-select form-select-lg" required>
                                    <option value="">Pilih Operasional</option>
                                    <option value="Jumlah Sales Force by Grading">Jumlah Sales Force by Grading</option>
                                    <option value="Jumlah Inquiry by Type">Jumlah Inquiry by Type</option>
                                    <option value="Jumlah Activity by Type">Jumlah Activity by Type</option>
                                    <option value="Source Of Inquiry">Source Of Inquiry</option>
                                    <option value="Issue">Issue</option>
                                    <option value="Usulan">Usulan</option>
                                </select>
                            </div>

                            {{-- KONDISI --}}
                            <div class="mb-4">
                                <label class="form-label">📌 Kondisi Yang Ada</label>
                                <textarea name="kondisi_yang_ada"
                                    rows="4"
                                    class="form-control"
                                    placeholder="Tuliskan kondisi yang ada..."></textarea>
                            </div>

                            {{-- ACTION --}}
                            <div class="mb-4">
                                <label class="form-label">🛠️ Action Perbaikan</label>
                                <textarea name="action_perbaikan"
                                    rows="4"
                                    class="form-control"
                                    placeholder="Tuliskan action perbaikan..."></textarea>
                            </div>

                            {{-- DO / DONT --}}
                            <div class="mb-4">
                                <label class="form-label">Do / Don't</label>
                                <select name="do_dont" class="form-select">
                                    <option value="">Pilih</option>
                                    <option value="V">✔ Do</option>
                                    <option value="X">✖ Don't</option>
                                </select>
                            </div>

                            {{-- BUTTON --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('summary.summaryaction.index') }}"
                                   class="btn btn-outline-secondary px-4">
                                    ← Kembali
                                </a>

                                <button class="btn btn-primary px-4 fw-semibold shadow-sm">
                                    <i class="bi bi-save me-1"></i> Simpan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
