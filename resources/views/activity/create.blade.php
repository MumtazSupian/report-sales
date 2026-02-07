@extends('layouts.app')

@section('content')
    <div style="padding: 40px 20px; display: flex; flex-direction: column; align-items: center; min-height: 100vh;">

        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="color: white; margin: 0; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">TAMBAH
                ACTIVITY PLAN</h2>
            <div style="width: 50px; height: 4px; background: #3182ce; margin: 10px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; margin: 5px 0 0 0; font-size: 14px;">Silakan isi formulir di bawah dengan lengkap dan
                teliti</p>
        </div>

        <div
            style="background: #ffffff; border-radius: 20px; padding: 40px; color: #333; box-shadow: 0 15px 35px rgba(0,0,0,0.3); width: 100%; max-width: 1000px;">

            <form id="formActivity" action="{{ route('activity.store') }}" method="POST">
                @csrf

                <div style="display: grid; gap: 30px;">

                    <div style="display: flex; gap: 30px;">
                        <div style="flex: 1;">
                            <label
                                style="display: block; margin-bottom: 10px; color: #2d3748; font-weight: 700; font-size: 13px; text-transform: uppercase;">Jenis
                                Activity</label>
                            <select name="jenis_activity"
                                style="width: 100%; padding: 14px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 10px; color: #2d3748; font-size: 15px;">
                                <option value="Offline">Offline</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>
                        <div style="flex: 1;">
                            <label
                                style="display: block; margin-bottom: 10px; color: #2d3748; font-weight: 700; font-size: 13px; text-transform: uppercase;">Activity</label>
                            <select name="activity"
                                style="width: 100%; padding: 14px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 10px; color: #2d3748; font-size: 15px;">
                                <option value="D_MARKETING">D. MARKETING</option>
                                <option value="EXHIBITION">EXHIBITION</option>
                                <option value="MOVING_EXHIBITION">MOVING EXHIBITION</option>
                                <option value="SHOWROOM_EVENT">SHOWROOM EVENT</option>
                                <option value="GROUP_PRESENTATION">GROUP PRESENTATION</option>
                                <option value="EVENT_TEST_DRIVE">EVENT TEST DRIVE</option>
                                <option value="OPEN_TABLE">OPEN TABLE</option>
                                <option value="CETAK_FLYER">CETAK FLYER</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label
                            style="display: block; margin-bottom: 10px; color: #2d3748; font-weight: 700; font-size: 13px; text-transform: uppercase;">Platform
                            / Lokasi</label>
                        <input type="text" name="platform_lokasi"
                            style="width: 100%; padding: 14px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 10px;"
                            placeholder="Masukkan lokasi kegiatan atau platform online">
                    </div>

                    <div style="background: #f0f9ff; padding: 25px; border-radius: 15px; border: 1px solid #bee3f8;">
                        <h3
                            style="color: #3182ce; margin-top: 0; font-size: 14px; margin-bottom: 20px; font-weight: 800; border-bottom: 2px solid #bee3f8; padding-bottom: 10px; display: inline-block; text-transform: uppercase;">
                            DISPLAY UNIT</h3>
                        <div style="display: flex; gap: 30px;">
                            <div style="flex: 1;">
                                <label
                                    style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 700; color: #4a5568;">Jenis
                                    Unit</label>
                                <select id="jenis_unit" name="jenis_unit"
                                    style="width: 100%; padding: 12px; background: white; border: 1px solid #cbd5e0; border-radius: 8px;">
                                    <option value="Commercial">Commercial</option>
                                    <option value="Passenger">Passenger</option>
                                </select>
                            </div>
                            <div style="flex: 1;">
                                <label
                                    style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 700; color: #4a5568;">Type
                                    Unit</label>
                                <select id="type_unit" name="type_unit"
                                    style="width: 100%; padding: 12px; background: white; border: 1px solid #cbd5e0; border-radius: 8px;">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 30px;">
                        <div>
                            <label
                                style="display: block; margin-bottom: 10px; color: #2d3748; font-weight: 700; font-size: 13px;">TANGGAL</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}"
                                style="width: 100%; padding: 12px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px;">
                        </div>
                        <div>
                            <label
                                style="display: block; margin-bottom: 10px; color: #2d3748; font-weight: 700; font-size: 13px;">JAM</label>
                            <input type="time" name="jam"
                                value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }}"
                                style="width: 100%; padding: 12px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px;">
                        </div>
                        <div>
                            <label
                                style="display: block; margin-bottom: 10px; color: #2d3748; font-weight: 700; font-size: 13px;">SALES
                                / SHIFT</label>
                            <input type="number" name="jml_sales_shift" placeholder="0"
                                style="width: 100%; padding: 12px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px;">
                        </div>
                    </div>

                    <div>
                        <label
                            style="display: block; margin-bottom: 10px; color: #2d3748; font-weight: 700; font-size: 13px;">PIC
                            KEGIATAN</label>
                        <input type="text" name="pic"
                            style="width: 100%; padding: 14px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 10px;"
                            placeholder="Masukkan nama penanggung jawab">
                    </div>

                    <div style="background: #fff5f5; padding: 25px; border-radius: 15px; border: 1px solid #fed7d7;">
                        <h3
                            style="color: #c53030; font-size: 14px; margin-bottom: 20px; font-weight: 800; border-bottom: 2px solid #fed7d7; padding-bottom: 10px; display: inline-block; text-transform: uppercase;">
                            TARGET & ACTUAL</h3>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 20px;">
                            <div>
                                <span style="font-size: 11px; font-weight: 800; color: #c53030;">TARGET P</span>
                                <input type="number" name="target_p"
                                    style="width: 100%; padding: 12px; border: 1px solid #feb2b2; border-radius: 8px; margin-top: 5px;">
                            </div>
                            <div>
                                <span style="font-size: 11px; font-weight: 800; color: #c53030;">TARGET HP</span>
                                <input type="number" name="target_hp"
                                    style="width: 100%; padding: 12px; border: 1px solid #feb2b2; border-radius: 8px; margin-top: 5px;">
                            </div>
                            <div>
                                <span style="font-size: 11px; font-weight: 800; color: #c53030;">TARGET SPK</span>
                                <input type="number" name="target_spk"
                                    style="width: 100%; padding: 12px; border: 1px solid #feb2b2; border-radius: 8px; margin-top: 5px;">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
                            <input type="number" name="actual_p" placeholder="Actual P"
                                style="padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; background: white;">
                            <input type="number" name="actual_hp" placeholder="Actual HP"
                                style="padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; background: white;">
                            <input type="number" name="actual_spk" placeholder="Actual SPK"
                                style="padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; background: white;">
                            <input type="number" name="actual_do" placeholder="Actual DO"
                                style="padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; background: white;">
                        </div>
                    </div>

                    <div style="display: flex; gap: 30px;">
                        <div style="flex: 1;">
                            <label
                                style="display: block; margin-bottom: 10px; color: #2d3748; font-weight: 700; font-size: 13px;">TOTAL
                                COST (Rp)</label>
                            <input type="number" name="total_cost"
                                style="width: 100%; padding: 14px; background: #fffaf0; border: 2px solid #feebc8; border-radius: 10px;"
                                placeholder="0">
                        </div>
                        <div style="flex: 2;">
                            <label
                                style="display: block; margin-bottom: 10px; color: #2d3748; font-weight: 700; font-size: 13px;">KETERANGAN</label>
                            <textarea name="keterangan" rows="2"
                                style="width: 100%; padding: 14px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 10px; font-family: inherit;"
                                placeholder="Keterangan tambahan..."></textarea>
                        </div>
                    </div>

                    <div
                        style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 10px; border-top: 2px solid #f7fafc; padding-top: 30px;">
                        <a href="{{ route('activity.index') }}"
                            style="padding: 14px 30px; background: #e2e8f0; color: #4a5568; border-radius: 10px; text-decoration: none; font-weight: 700; transition: 0.3s;">BATAL</a>
                        <button type="button" onclick="confirmSimpan()"
                            style="padding: 14px 45px; background: #1a202c; color: white; border-radius: 10px; border: none; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.3); transition: 0.3s;">SIMPAN
                            AKTIVITAS</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSimpan() {
            Swal.fire({
                title: 'Simpan Data?',
                text: "Pastikan semua input sudah sesuai paman!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1a202c',
                cancelButtonColor: '#e53e3e',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Cek Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formActivity').submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const jenisSelect = document.getElementById('jenis_unit');
            const typeSelect = document.getElementById('type_unit');

            const typeUnits = {
                Commercial: ['CARRY_PU', 'CARRY_BOX', 'CARRY_BV', 'CARRY_MOKO', 'CARRY_AMBULANCE',
                    'CARRY_TOWING'
                ],
                Passenger: ['APV_MB', 'APV_AMBULANCE', 'ERTIGA', 'ERTIGA_HYBRID', 'XL7', 'XL7_HYBRID',
                    'S_PRESSO', 'IGNIS', 'BALENO', 'GRAND_VITARA', 'JIMNY'
                ]
            };

            function updateTypeUnit() {
                const selectedJenis = jenisSelect.value;
                const options = typeUnits[selectedJenis] || [];
                typeSelect.innerHTML = '';

                options.forEach(type => {
                    const opt = document.createElement('option');
                    opt.value = type;
                    opt.textContent = type.replace(/_/g, ' ');
                    typeSelect.appendChild(opt);
                });
            }

            updateTypeUnit();
            jenisSelect.addEventListener('change', updateTypeUnit);
        });
    </script>
@endsection
