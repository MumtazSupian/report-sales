@extends('layouts.app')
@section('content')
    <div style="padding: 40px 20px; display: flex; flex-direction: column; align-items: center; min-height: 100vh;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="color: white; margin: 0; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">EDIT
                ACTIVITY PLAN</h2>
            <div style="width: 50px; height: 4px; background: #e53e3e; margin: 10px auto; border-radius: 10px;"></div>
            <p style="color: #cbd5e0; margin: 5px 0 0 0; font-size: 14px;">Perbarui data rencana dan realisasi aktivitas</p>
            <br>
            <p style="text-align:center; color: #e1e1e1; font-size: 13px; margin-bottom: 15px;">
                Menginput data untuk Cabang: <strong style="color: #ffffff;">{{ Auth::user()->cabang }}</strong>
            </p>
        </div>
        <div
            style="background: #ffffff; border-radius: 20px; padding: 40px; color: #333; box-shadow: 0 15px 35px rgba(0,0,0,0.3); width: 100%; max-width: 1000px;">
            <form id="formEditActivity" action="{{ route('activity.plan.update', $activity->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div style="display: grid; gap: 30px;">
                    <div
                        style="border-left: 5px solid #3182ce; padding-left: 25px; background: #f0f9ff; padding: 25px; border-radius: 0 15px 15px 0;">
                        <h3
                            style="color: #3182ce; margin-top: 0; font-size: 15px; margin-bottom: 20px; font-weight: 800; text-transform: uppercase;">
                            A. Activity Plan</h3>
                        <div style="display: flex; gap: 25px; margin-bottom: 20px;">
                            <div style="flex: 1;"><label
                                    style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">JENIS
                                    ACTIVITY</label><select name="jenis_activity"
                                    style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                                    <option value="Offline" {{ $activity->jenis_activity == 'Offline' ? 'selected' : '' }}>
                                        Offline</option>
                                    <option value="Online" {{ $activity->jenis_activity == 'Online' ? 'selected' : '' }}>
                                        Online</option>
                                </select></div>
                            <div style="flex: 1;"><label
                                    style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">ACTIVITY</label><select
                                    name="activity"
                                    style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;">
                                    @foreach (['D_MARKETING', 'EXHIBITION', 'MOVING_EXHIBITION', 'SHOWROOM_EVENT', 'GROUP_PRESENTATION', 'EVENT_TEST_DRIVE', 'OPEN_TABLE', 'CETAK_FLYER'] as $act)
                                        <option value="{{ $act }}"
                                            {{ $activity->activity == $act ? 'selected' : '' }}>
                                            {{ str_replace('_', ' ', $act) }}</option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div><label style="display: block; margin-bottom: 8px; font-weight: 700; font-size: 13px;">PLATFORM
                                / LOKASI</label><input type="text" name="platform_lokasi"
                                value="{{ $activity->platform_lokasi }}"
                                style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px;"></div>
                    </div>
                    <div
                        style="border-left: 5px solid #e53e3e; padding-left: 25px; background: #fff5f5; padding: 25px; border-radius: 0 15px 15px 0;">
                        <h3
                            style="color: #c53030; margin-top: 0; font-size: 15px; margin-bottom: 20px; font-weight: 800; text-transform: uppercase;">
                            B. Activity Actual (Update Hasil)</h3>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 15px;">
                            <div><span style="font-size: 11px; font-weight: 800; color: #c53030;">TARGET P</span><input
                                    type="number" name="target_p" value="{{ $activity->target_p }}"
                                    style="width: 100%; padding: 10px; border: 1px solid #feb2b2; border-radius: 8px;">
                            </div>
                            <div><span style="font-size: 11px; font-weight: 800; color: #c53030;">TARGET HP</span><input
                                    type="number" name="target_hp" value="{{ $activity->target_hp }}"
                                    style="width: 100%; padding: 10px; border: 1px solid #feb2b2; border-radius: 8px;">
                            </div>
                            <div><span style="font-size: 11px; font-weight: 800; color: #c53030;">TARGET SPK</span><input
                                    type="number" name="target_spk" value="{{ $activity->target_spk }}"
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
                    <div
                        style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 10px; border-top: 2px solid #f7fafc; padding-top: 30px;">
                        <a href="{{ route('activity.plan.index') }}"
                            style="padding: 14px 30px; background: #e2e8f0; color: #4a5568; border-radius: 10px; text-decoration: none; font-weight: 700;">BATAL</a>
                        <button type="submit"
                            style="padding: 14px 45px; background: #1a202c; color: white; border-radius: 10px; border: none; font-weight: 700; cursor: pointer;">UPDATE
                            AKTIVITAS</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
