<?php
namespace App\Http\Controllers\current;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\current\ActualSalesByLeasing;

class ActualSalesByLeasingController extends Controller
{
    public function index()
    {
        $data = ActualSalesByLeasing::orderBy('tahun', 'desc')->get();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        return view('actual_sales_by_leasing.index', compact('data', 'months'));
    }

    public function create()
    {
        $leasingOptions = [
            'tunai',
            'suzuki_finance',
            'bca_finance',
            'kbb_bca',
            'mandiri_tunas_finance',
            'kbb_mandiri',
            'bsi',
            'mandiri_utama_finance',
            'indomobil_finance',
            'adira_finance',
            'bni_finance',
            'maybank',
            'oto_multiartha_finance',
            'niaga_finance',
            'clipan_finance',
            'lain_lain'
        ];
        return view('current.actual_sales_by_leasing.create', compact('leasingOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $data['total'] = 0;
        foreach ($months as $m) {
            $data[$m] = $request->input($m, 0);
            $data['total'] += $data[$m];
        }
        ActualSalesByLeasing::create($data);
        return redirect()->route('current.actual-sales-by-leasing.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $row = ActualSalesByLeasing::findOrFail($id);
        $leasingOptions = [
            'tunai',
            'suzuki finance',
            'bca finance',
            'kbb bca',
            'mandiri tunas finance',
            'kbb mandiri',
            'bsi',
            'mandiri utama finance',
            'indomobil finance',
            'adira finance',
            'bni finance',
            'maybank',
            'oto multiartha finance',
            'niaga finance',
            'clipan finance',
            'lain lain'
        ];
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        return view('current.actual_sales_by_leasing.edit', compact('row', 'leasingOptions', 'months'));
    }

    public function update(Request $request, $id)
    {
        $row = ActualSalesByLeasing::findOrFail($id);
        $data = $request->all();
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
        $data['total'] = 0;
        foreach ($months as $m) {
            $data[$m] = $request->input($m, 0);
            $data['total'] += $data[$m];
        }
        $row->update($data);
        return redirect()->route('current.actual-sales-by-leasing.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $row = ActualSalesByLeasing::findOrFail($id);
        $row->delete();
        return redirect()->route('current.actual-sales-by-leasing.index')->with('success', 'Data berhasil dihapus!');
    }
}
