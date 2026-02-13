@extends('layouts.app')

@section('content')
    <div style="padding: 40px 20px; display: flex; flex-direction: column; align-items: center; min-height: 100vh;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-weight:800; color:#fff; letter-spacing:1px; text-transform:uppercase; margin:0;">
                TAMBAH ACTUAL INQUIRY BY TYPE
            </h2>
            <div style="width: 50px; height: 4px; background: #3182ce; margin: 10px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; font-size: 14px;">Input data aktual inquiry baru berdasarkan kategori dan tipe unit per bulan</p>
        </div>

        <div
            style="background: white; width: 100%; max-width: 1200px; padding: 35px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            
            <form id="actualInquiryForm" action="{{ route('current.actual-inquary-by-type.store') }}" method="POST" x-data="targetForm()">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 10px;">
                    <div>
                        <label
                            style="display: block; font-weight: 700; color: #2d3748; margin-bottom: 8px; font-size: 13px; text-transform: uppercase;">Tahun</label>
                        <input type="number" name="tahun" value="{{ date('Y') }}" required
                            style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #4a5568;">
                    </div>
                </div>

                <div style="margin: 25px 0 15px 0; border-bottom: 2px dashed #edf2f7;"></div>
                <p style="text-align:center; color: #718096; font-size: 12px; margin-bottom: 15px;">
                    Menginput data untuk Cabang: <strong style="color: #2d3748;">{{ Auth::user()->cabang }}</strong>
                </p>

                <!-- Month Grid -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px;">
                    <template x-for="month in months" :key="month">
                        <div style="background: #ffff; padding: 20px; border-radius: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                            <div style="background: #ebf8ff; color: #2b6cb0; padding: 10px; border-radius: 8px; font-weight: 800; text-transform: uppercase; text-align: center; margin-bottom: 15px; letter-spacing: 1px;">
                                <span x-text="month"></span>
                            </div>

                            <!-- Commercial Section -->
                            <div style="margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; border-bottom: 2px solid #edf2f7; padding-bottom: 5px;">
                                    <span style="font-size: 13px; font-weight: 700; color: #4a5568;">COMMERCIAL</span>
                                    <button type="button" @click="addRow(month, 'Commercial')"
                                        style="background: #48bb78; color: white; border: none; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold;">+</button>
                                </div>
                                
                                <template x-for="(row, index) in data[month].Commercial" :key="row.id">
                                    <div style="display: flex; gap: 5px; margin-bottom: 8px;">
                                        <select :name="`targets[${month}][Commercial][${index}][type]`" x-model="row.type" required
                                            style="flex: 2; padding: 6px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 12px;">
                                            <option value="" disabled>Pilih Unit</option>
                                            <template x-for="unit in commercial_units" :key="unit">
                                                <option :value="unit" x-text="unit"></option>
                                            </template>
                                        </select>
                                        <input type="number" :name="`targets[${month}][Commercial][${index}][amount]`" x-model="row.amount" min="1" placeholder="Qty" required
                                            style="flex: 1; padding: 6px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 12px; text-align: center;">
                                        <button type="button" @click="removeRow(month, 'Commercial', index)"
                                            style="background: #fc8181; color: white; border: none; width: 24px; height: 24px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>
                                    </div>
                                </template>
                                <div x-show="data[month].Commercial.length === 0" style="text-align: center; font-style: italic; color: #a0aec0; font-size: 11px; padding: 5px;">
                                    Belum ada data
                                </div>
                            </div>

                            <!-- Passenger Section -->
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; border-bottom: 2px solid #edf2f7; padding-bottom: 5px;">
                                    <span style="font-size: 13px; font-weight: 700; color: #4a5568;">PASSENGER</span>
                                    <button type="button" @click="addRow(month, 'Passenger')"
                                        style="background: #4299e1; color: white; border: none; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold;">+</button>
                                </div>

                                <template x-for="(row, index) in data[month].Passenger" :key="row.id">
                                    <div style="display: flex; gap: 5px; margin-bottom: 8px;">
                                        <select :name="`targets[${month}][Passenger][${index}][type]`" x-model="row.type" required
                                            style="flex: 2; padding: 6px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 12px;">
                                            <option value="" disabled>Pilih Unit</option>
                                            <template x-for="unit in passenger_units" :key="unit">
                                                <option :value="unit" x-text="unit"></option>
                                            </template>
                                        </select>
                                        <input type="number" :name="`targets[${month}][Passenger][${index}][amount]`" x-model="row.amount" min="1" placeholder="Qty" required
                                            style="flex: 1; padding: 6px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 12px; text-align: center;">
                                        <button type="button" @click="removeRow(month, 'Passenger', index)"
                                            style="background: #fc8181; color: white; border: none; width: 24px; height: 24px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>
                                    </div>
                                </template>
                                <div x-show="data[month].Passenger.length === 0" style="text-align: center; font-style: italic; color: #a0aec0; font-size: 11px; padding: 5px;">
                                    Belum ada data
                                </div>
                            </div>

                        </div>
                    </template>
                </div>

                <div style="margin-top: 35px; display: flex; gap: 15px;">
                    <a href="{{ route('current.actual-inquary-by-type.index') }}"
                        style="flex: 1; padding: 14px; background: #edf2f7; color: #4a5568; text-align: center; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px;">Batal</a>
                    <button type="button" @click="confirmSubmit()"
                        style="flex: 2; padding: 14px; background: #1a202c; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function targetForm() {
            const months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
            let initialData = {};
            months.forEach(m => {
                initialData[m] = {
                    Commercial: [],
                    Passenger: []
                };
            });

            return {
                months: months,
                commercial_units: @json($commercial_units),
                passenger_units: @json($passenger_units),
                data: initialData,
                
                init() {
                    // Data already initialized
                },

                addRow(month, category) {
                    this.data[month][category].push({
                        id: Date.now() + Math.random(),
                        type: '',
                        amount: ''
                    });
                },

                removeRow(month, category, index) {
                    this.data[month][category].splice(index, 1);
                },

                confirmSubmit() {
                    let hasData = false;
                    for (const m of this.months) {
                        for (const cat of ['Commercial', 'Passenger']) {
                            for (const row of this.data[m][cat]) {
                                if (row.type && row.amount > 0) {
                                    hasData = true;
                                    break;
                                }
                            }
                            if (hasData) break;
                        }
                        if (hasData) break;
                    }

                    if (!hasData) {
                        Swal.fire('Peringatan', 'Mohon isi setidaknya satu data dengan Tipe Unit dan Jumlah > 0', 'warning');
                        return;
                    }

                    Swal.fire({
                        title: 'Simpan Data?',
                        text: "Pastikan data yang diinput sudah benar. Lanjutkan?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3182ce',
                        cancelButtonColor: '#e53e3e',
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Cek Kembali'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('actualInquiryForm').submit();
                        }
                    });
                }
            }
        }
    </script>
@endsection
