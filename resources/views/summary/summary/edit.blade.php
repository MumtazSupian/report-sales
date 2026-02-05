<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Summary</title>
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
                📊 Summary Improvement
            </span>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-pencil-square me-2"></i> Edit Summary Operasional
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('summary.summary.update', $summary->id) }}" method="POST">
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

                            {{-- Operasional --}}
                            <div class="mb-4">
                                <label class="form-label">Operasional</label>
                                <select name="operasional" class="form-select form-select-lg" required>
                                    @foreach ($ops as $op)
                                        <option value="{{ $op }}"
                                            {{ $summary->operasional == $op ? 'selected' : '' }}>
                                            {{ $op }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Plan --}}
                            <div class="mb-4">
                                <label class="form-label">📌 Plan Rencana Perbaikan</label>
                                <textarea name="plan_perbaikan"
                                    rows="4"
                                    class="form-control"
                                    placeholder="Tuliskan rencana perbaikan...">{{ $summary->plan_perbaikan }}</textarea>
                            </div>

                            {{-- Aktual --}}
                            <div class="mb-4">
                                <label class="form-label">✅ Aktual Pelaksanaan</label>
                                <textarea name="aktual_perbaikan"
                                    rows="4"
                                    class="form-control"
                                    placeholder="Tuliskan aktual pelaksanaan...">{{ $summary->aktual_perbaikan }}</textarea>
                            </div>

                            {{-- Do / Don't --}}
                            <div class="mb-4">
                                <label class="form-label">Do / Don't</label>
                                <select name="do_dont" class="form-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="V" {{ $summary->do_dont == 'V' ? 'selected' : '' }}>
                                        ✔ Do
                                    </option>
                                    <option value="X" {{ $summary->do_dont == 'X' ? 'selected' : '' }}>
                                        ✖ Don't
                                    </option>
                                </select>
                            </div>

                            {{-- BUTTON --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('summary.summary.index') }}"
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
