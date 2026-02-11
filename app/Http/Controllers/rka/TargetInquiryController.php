<?php

namespace App\Http\Controllers\rka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rka\TargetInquiry;
use Illuminate\Support\Facades\Auth;

class TargetInquiryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pusatRoles = ['Admin', 'OM', 'Admin DCA', 'OM DCA'];

        if (in_array($user->role, $pusatRoles)) {
            $data = TargetInquiry::all();
        } else {
            $data = TargetInquiry::where('cabang', $user->cabang)->get();
        }

        return view('rka.target_inquiries.index', compact('data'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'BM') {
            return redirect()->route('rka.target-inquiries.index')->with('error', 'Akses dibatasi.');
        }
        return view('rka.target_inquiries.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'BM') {
            return redirect()->route('rka.target-inquiries.index')->with('error', 'Hanya BM yang bisa menambah data.');
        }

        $total =
            $request->jan + $request->feb + $request->mar +
            $request->apr + $request->mei + $request->jun +
            $request->jul + $request->agu + $request->sep +
            $request->okt + $request->nov + $request->des;

        TargetInquiry::create([
            'source_inquiry' => $request->source_inquiry,
            'tahun' => $request->tahun,
            'jan' => $request->jan,
            'feb' => $request->feb,
            'mar' => $request->mar,
            'apr' => $request->apr,
            'mei' => $request->mei,
            'jun' => $request->jun,
            'jul' => $request->jul,
            'agu' => $request->agu,
            'sep' => $request->sep,
            'okt' => $request->okt,
            'nov' => $request->nov,
            'des' => $request->des,
            'total' => $total,
            'cabang' => $user->cabang, 
        ]);

        return redirect()->route('rka.target-inquiries.index')->with('success', 'Data target inquiry berhasil disimpan');
    }

    public function edit($id)
    {
        $data = TargetInquiry::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('rka.target-inquiries.index')->with('error', 'Anda tidak punya akses untuk mengedit data ini.');
        }

        return view('rka.target_inquiries.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = TargetInquiry::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('rka.target-inquiries.index')->with('error', 'Akses ilegal.');
        }

        $total =
            $request->jan + $request->feb + $request->mar +
            $request->apr + $request->mei + $request->jun +
            $request->jul + $request->agu + $request->sep +
            $request->okt + $request->nov + $request->des;

        $data->update([
            'source_inquiry' => $request->source_inquiry,
            'tahun' => $request->tahun,
            'jan' => $request->jan,
            'feb' => $request->feb,
            'mar' => $request->mar,
            'apr' => $request->apr,
            'mei' => $request->mei,
            'jun' => $request->jun,
            'jul' => $request->jul,
            'agu' => $request->agu,
            'sep' => $request->sep,
            'okt' => $request->okt,
            'nov' => $request->nov,
            'des' => $request->des,
            'total' => $total,
        ]);

        return redirect()->route('rka.target-inquiries.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = TargetInquiry::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'BM' || $data->cabang != $user->cabang) {
            return redirect()->route('rka.target-inquiries.index')->with('error', 'Dilarang menghapus data cabang lain.');
        }

        $data->delete();

        return redirect()->route('rka.target-inquiries.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
