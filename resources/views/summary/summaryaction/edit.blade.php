<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Action</title>
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
                            <i class="bi bi-pencil-square me-2"></i> Edit Action Perbaikan
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('summary.summaryaction.update', $summary_actions->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @php
                                $ops = [
                                    'Jumlah Sales Force by Grading',
                                    'Jumlah Inquiry by Type',
                                    'Jumlah Activity by Type',
                                    'Source Of Inquiry',
                                    'Issue',
                                    'Usulan',
                                ];
                            @endphp

                            {{-- OPERASIONAL --}}
                            <div class="mb-4">
                                <label class="form-label">Operasional</label>
                                <select name="operasional" class="form-select form-select-lg" required>
                                    @foreach ($ops as $op)
                                        <option value="{{ $op }}"
                                            {{ $summary_actions->operasional == $op ? 'selected' : '' }}>
                                            {{ $op }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- KONDISI --}}
                            <div class="mb-4">
                                <label class="form-label">📌 Kondisi Yang Ada</label>
                                <textarea name="kondisi_yang_ada" rows="4" class="form-control" placeholder="Tuliskan kondisi yang ada...">{{ $summary_actions->kondisi_yang_ada }}</textarea>
                            </div>

                            {{-- ACTION --}}
                            <div class="mb-4">
                                <label class="form-label">🛠️ Action Perbaikan</label>
                                <textarea name="action_perbaikan" rows="4" class="form-control" placeholder="Tuliskan action perbaikan...">{{ $summary_actions->action_perbaikan }}</textarea>
                            </div>

                            {{-- DO / DONT --}}
                            <div class="mb-4">
                                <label class="form-label">Do / Don't</label>
                                <select name="do_dont" class="form-select">
                                    <option value="">Pilih</option>
                                    <option value="V" {{ $summary_actions->do_dont == 'V' ? 'selected' : '' }}>
                                        ✔ Do
                                    </option>
                                    <option value="X" {{ $summary_actions->do_dont == 'X' ? 'selected' : '' }}>
                                        ✖ Don't
                                    </option>
                                </select>
                            </div>

                            {{-- BUTTON --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('summary.summaryaction.index') }}"
                                    class="btn btn-outline-secondary px-4">
                                    ← Kembali
                                </a>

                                <button class="btn btn-primary px-4 fw-semibold shadow-sm">
                                    <i class="bi bi-arrow-repeat me-1"></i> Update
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
