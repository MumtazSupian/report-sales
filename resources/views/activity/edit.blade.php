@extends('layouts.app')

@section('content')
    <div style="padding: 40px 20px; display: flex; flex-direction: column; align-items: center; min-height: 100vh;">

        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="color: white; margin: 0; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">EDIT
                ACTIVITY PLAN</h2>
            <div style="width: 50px; height: 4px; background: #e53e3e; margin: 10px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; margin: 5px 0 0 0; font-size: 14px;">Perbarui data rencana dan realisasi aktivitas</p>
        </div>

        <div
            style="background: #ffffff; border-radius: 20px; padding: 40px; color: #333; box-shadow: 0 15px 35px rgba(0,0,0,0.3); width: 100%; max-width: 1000px;">

            <form id="formEditActivity" action="{{ route('activity.update', $activity->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="display: grid; gap: 30px;">

                    <div
                        style="border-left: 5px solid #3182ce; padding-left: 25px; background: #f0f9ff; padding: 25px; border-radius: 0 15px 15px 0;">
                        <h3
                            style="color: #3182ce; margin-top: 0; font-size: 15px; margin-bottom: 20px; font-weight: 800; text-transform: uppercase;">
                            A. Activity Plan</h3>

                        <div style="display: flex; gap: 25px; margin-bottom: 20px;">
                            <div style="flex: 1;">
                                <label style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">JENIS
                                    ACTIVITY</label>
                                <select name="jenis_activity"
                                    style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                                    <option value="Offline" {{ $activity->jenis_activity == 'Offline' ? 'selected' : '' }}>
                                        Offline</option>
                                    <option value="Online" {{ $activity->jenis_activity == 'Online' ? 'selected' : '' }}>
                                        Online</option>
                                </select>
                            </div>
                            <div style="flex: 1;">
                                <label
                                    style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">ACTIVITY</label>
                                <select name="activity"
                                    style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                                    @foreach (['D_MARKETING', 'EXHIBITION', 'MOVING_EXHIBITION', 'SHOWROOM_EVENT', 'GROUP_PRESENTATION', 'EVENT_TEST_DRIVE', 'OPEN_TABLE', 'CETAK_FLYER'] as $act)
                                        <option value="{{ $act }}"
                                            {{ $activity->activity == $act ? 'selected' : '' }}>
                                            {{ str_replace('_', ' ', $act) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">PLATFORM /
                                LOKASI</label>
                            <input type="text" name="platform_lokasi" value="{{ $activity->platform_lokasi }}"
                                style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                        </div>
                    </div>

                    <div
                        style="border-left: 5px solid #e53e3e; padding-left: 25px; background: #fff5f5; padding: 25px; border-radius: 0 15px 15px 0;">
                        <h3
                            style="color: #c53030; margin-top: 0; font-size: 15px; margin-bottom: 20px; font-weight: 800; text-transform: uppercase;">
                            B. Activity Actual (Update Hasil)</h3>

                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 15px;">
                            <div>
                                <span style="font-size: 11px; font-weight: 800; color: #c53030;">TARGET P</span>
                                <input type="number" name="target_p" value="{{ $activity->target_p }}"
                                    style="width: 100%; padding: 10px; border: 1px solid #feb2b2; border-radius: 8px;">
                            </div>
                            <div>
                                <span style="font-size: 11px; font-weight: 800; color: #c53030;">TARGET HP</span>
                                <input type="number" name="target_hp" value="{{ $activity->target_hp }}"
                                    style="width: 100%; padding: 10px; border: 1px solid #feb2b2; border-radius: 8px;">
                            </div>
                            <div>
                                <span style="font-size: 11px; font-weight: 800; color: #c53030;">TARGET SPK</span>
                                <input type="number" name="target_spk" value="{{ $activity->target_spk }}"
                                    style="width: 100%; padding: 10px; border: 1px solid #feb2b2; border-radius: 8px;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
                            <input type="number" name="actual_p" value="{{ $activity->actual_p }}" placeholder="Actual P"
                                style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 8px;">
                            <input type="number" name="actual_hp" value="{{ $activity->actual_hp }}"
                                placeholder="Actual HP"
                                style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 8px;">
                            <input type="number" name="actual_spk" value="{{ $activity->actual_spk }}"
                                placeholder="Actual SPK"
                                style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 8px;">
                            <input type="number" name="actual_do" value="{{ $activity->actual_do }}"
                                placeholder="Actual DO"
                                style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 8px;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                        <div style="display: grid; gap: 15px;">
                            <div style="display: flex; gap: 15px;">
                                <div style="flex: 1;">
                                    <label
                                        style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">JENIS
                                        UNIT</label>
                                    <select id="jenis_unit" name="jenis_unit"
                                        style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                                        <option value="Commercial"
                                            {{ $activity->jenis_unit == 'Commercial' ? 'selected' : '' }}>Commercial
                                        </option>
                                        <option value="Passenger"
                                            {{ $activity->jenis_unit == 'Passenger' ? 'selected' : '' }}>Passenger</option>
                                    </select>
                                </div>
                                <div style="flex: 1;">
                                    <label
                                        style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">TYPE
                                        UNIT</label>
                                    <select id="type_unit" name="type_unit" data-current="{{ $activity->type_unit }}"
                                        style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label
                                    style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">PIC</label>
                                <input type="text" name="pic" value="{{ $activity->pic }}"
                                    style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                            </div>
                        </div>

                        <div style="display: grid; gap: 15px;">
                            <div style="display: flex; gap: 15px;">
                                <div style="flex: 1;">
                                    <label
                                        style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">TANGGAL</label>
                                    <input type="date" name="tanggal" value="{{ $activity->tanggal }}"
                                        style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                                </div>
                                <div style="flex: 1;">
                                    <label
                                        style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">JAM</label>
                                    <input type="time" name="jam" value="{{ $activity->jam }}"
                                        style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                                </div>
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">SALES
                                    / SHIFT</label>
                                <input type="text" name="jml_sales_shift" value="{{ $activity->jml_sales_shift }}"
                                    style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 30px;">
                        <div style="flex: 1;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">TOTAL
                                COST (Rp)</label>
                            <input type="number" name="total_cost" value="{{ $activity->total_cost }}"
                                style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; background: #fffaf0;">
                        </div>
                        <div style="flex: 2;">
                            <label
                                style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">KETERANGAN /
                                EVALUASI</label>
                            <textarea name="keterangan" rows="2"
                                style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-family: inherit;">{{ $activity->keterangan }}</textarea>
                        </div>
                    </div>

                    <div
                        style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 10px; border-top: 2px solid #f7fafc; padding-top: 30px;">
                        <a href="{{ route('activity.index') }}"
                            style="padding: 14px 30px; background: #e2e8f0; color: #4a5568; border-radius: 10px; text-decoration: none; font-weight: 700;">KEMBALI</a>
                        <button type="button" onclick="confirmUpdate()"
                            style="padding: 14px 45px; background: #2d3748; color: white; border-radius: 10px; border: none; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">UPDATE
                            DATA</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmUpdate() {
            Swal.fire({
                title: 'Update Data?',
                text: "Seluruh perubahan akan disimpan ke database.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#2d3748',
                cancelButtonColor: '#e53e3e',
                confirmButtonText: 'Ya, Update!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formEditActivity').submit();
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

            function updateTypeUnit(selected = null) {
                const options = typeUnits[jenisSelect.value] || [];
                typeSelect.innerHTML = '';
                options.forEach(type => {
                    const opt = document.createElement('option');
                    opt.value = type;
                    opt.textContent = type.replace(/_/g, ' ');
                    if (selected === type) opt.selected = true;
                    typeSelect.appendChild(opt);
                });
            }

            updateTypeUnit(typeSelect.dataset.current);
            jenisSelect.addEventListener('change', () => updateTypeUnit());
        });
    </script>
@endsection
