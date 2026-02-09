<div style="background-color: #a3d2ff; min-height: 100vh; display: flex; justify-content: center; align-items: center; font-family: 'Segoe UI', Tahoma, sans-serif; margin: 0; padding: 0;">
    <div style="background: #ffffff; padding: 40px; border-radius: 4px; box-shadow: 15px 15px 0px rgba(0,0,0,0.1); width: 100%; max-width: 480px; border: 2px solid #000;">
        
        <div style="margin-bottom: 30px; border-bottom: 3px solid #000080; padding-bottom: 15px;">
            <h1 style="color: #000080; font-size: 28px; font-weight: 900; margin: 0; letter-spacing: -1px;">DCA SYSTEM</h1>
            <p style="font-size: 14px; font-weight: bold; margin: 5px 0 0 0; color: #333;">VSV Report (Vehicle Sales Volume)</p>
            <p style="font-size: 11px; color: #666; text-transform: uppercase; letter-spacing: 1px;">PT. Duta Cendana Adimandiri</p>
        </div>

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            
            @if($errors->any())
                <div style="background: #fee2e2; color: #b91c1c; padding: 12px; margin-bottom: 20px; font-size: 13px; border: 1px solid #f87171; border-radius: 4px;">
                    <strong>Waduh!</strong> {{ $errors->first() }}
                </div>
            @endif

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 13px; font-weight: 800; margin-bottom: 8px; color: #000;">DISIAPKAN OLEH:</label>
                <select name="name" required style="width: 100%; padding: 10px; border: 2px solid #000; background: #fff; font-weight: bold; cursor: pointer;">
                    <option value="" disabled selected>-- Pilih Personel --</option>
                    <option value="Ade">Ade</option>
                    <option value="Afri">Afri</option>
                    <option value="Bagja">Bagja</option>
                    <option value="Ronald">Ronald</option>
                    <option value="Aria">Aria</option>
                    <option value="OM DCA">OM DCA</option>
                    <option value="Admin DCA">Admin DCA</option>
                </select>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 13px; font-weight: 800; margin-bottom: 8px; color: #000;">PERIODE:</label>
                <select name="periode" style="width: 100%; padding: 10px; border: 2px solid #000; background: #fff; font-weight: bold; cursor: pointer;">
                    @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        <option value="{{ $month }}" {{ $month == 'February' ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 13px; font-weight: 800; margin-bottom: 8px; color: #000;">CABANG:</label>
                <select name="cabang" style="width: 100%; padding: 10px; border: 2px solid #000; background: #fff; font-weight: bold; cursor: pointer;">
                    <option value="Cianjur">Cianjur</option>
                    <option value="Ciawi">Ciawi</option>
                    <option value="Cinere">Cinere</option>
                    <option value="Cipanas">Cipanas</option>
                    <option value="Jatiasih">Jatiasih</option>
                    <option value="Pusat">Pusat</option>
                </select>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 13px; font-weight: 800; margin-bottom: 8px; color: #000;">PASSWORD:</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; border: 2px solid #000; box-sizing: border-box;">
            </div>

            <button type="submit" style="background: #000080; color: white; padding: 14px; border: none; font-weight: 900; cursor: pointer; width: 100%; letter-spacing: 2px; text-transform: uppercase; transition: 0.3s ease; box-shadow: 4px 4px 0px #000;">
                MASUK KE SYSTEM
            </button>

            <div style="margin-top: 25px; font-size: 11px; color: #b91c1c; font-weight: bold; text-align: center; border-top: 1px dashed #ccc; padding-top: 15px;">
                PENTING: Gunakan akun resmi untuk akses laporan.
            </div>
        </form>
    </div>
</div> 