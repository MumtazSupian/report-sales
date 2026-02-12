<div style="background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%); min-height: 100vh; display: flex; justify-content: center; align-items: center; font-family: 'Inter', system-ui, -apple-system, sans-serif; margin: 0; padding: 20px;">

    <div style="background: #ffffff; width: 100%; max-width: 750px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); overflow: hidden; display: flex; flex-direction: column;">

        <div style="background: #001e50; padding: 25px 40px; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid #ef4444;">
            <div>
                <h1 style="color: #ffffff; font-size: 24px; font-weight: 900; margin: 0; letter-spacing: 1px;">DCA SYSTEM</h1>
                <p style="font-size: 13px; color: #94a3b8; margin: 0; font-weight: 500;">Vehicle Sales Volume Report</p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 10px; color: #ffffff; opacity: 0.8; text-transform: uppercase; letter-spacing: 2px; margin: 0;">PT. Duta Cendana Adimandiri</p>
                <div style="font-size: 11px; color: #ef4444; font-weight: bold; margin-top: 4px;">OFFICIAL LOGIN</div>
            </div>
        </div>

        <form action="{{ url('/login') }}" method="POST" style="padding: 30px 40px;">
            @csrf

            @if($errors->any())
                <div style="background: #fef2f2; color: #dc2626; padding: 12px 15px; margin-bottom: 20px; font-size: 13px; border-radius: 8px; border: 1px solid #fee2e2;">
                    <strong>Error:</strong> {{ $errors->first() }}
                </div>
            @endif

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px 30px;">

                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 12px; font-weight: 800; margin-bottom: 8px; color: #475569; text-transform: uppercase;">Disiapkan Oleh</label>
                    <select name="name" required style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; background: #f8fafc; font-size: 15px; outline: none; cursor: pointer;">
                        <option value="" disabled selected>Pilih Personel</option>
                        <option value="Ade">Ade</option>
                        <option value="Afri">Afri</option>
                        <option value="Bagja">Bagja</option>
                        <option value="Ronald">Ronald</option>
                        <option value="Aria">Aria</option>
                        <option value="OM DCA">OM DCA</option>
                        <option value="Admin DCA">Admin DCA</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 800; margin-bottom: 8px; color: #475569; text-transform: uppercase;">Periode</label>
                    <select name="periode" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; background: #f8fafc; font-size: 15px; outline: none;">
                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                            <option value="{{ $month }}" {{ $month == 'February' ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 800; margin-bottom: 8px; color: #475569; text-transform: uppercase;">Cabang</label>
                    <select name="cabang" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; background: #f8fafc; font-size: 15px; outline: none;">
                        <option value="Cianjur">Cianjur</option>
                        <option value="Ciawi">Ciawi</option>
                        <option value="Cinere">Cinere</option>
                        <option value="Cipanas">Cipanas</option>
                        <option value="Jatiasih">Jatiasih</option>
                        <option value="Pusat">Pusat</option>
                    </select>
                </div>

                <div style="grid-column: span 2; margin-top: 5px;">
                    <label style="display: block; font-size: 12px; font-weight: 800; margin-bottom: 8px; color: #475569; text-transform: uppercase;">Password</label>
                    <input type="password" name="password" required placeholder="••••••••" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px; background: #f8fafc; box-sizing: border-box; font-size: 15px; outline: none;">
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 20px; margin-top: 30px; border-top: 1px solid #f1f5f9; padding-top: 25px;">
                <button type="submit" style="flex: 2; background: #ef4444; color: white; padding: 15px; border: none; border-radius: 10px; font-weight: 800; cursor: pointer; font-size: 15px; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);">
                    Masuk ke System
                </button>
                <div style="flex: 1; font-size: 10px; color: #94a3b8; line-height: 1.4; border-left: 2px solid #e2e8f0; padding-left: 15px;">
                    Pastikan data yang Anda masukkan sudah sesuai dengan cabang penempatan.
                </div>
            </div>
        </form>
    </div>
</div>
