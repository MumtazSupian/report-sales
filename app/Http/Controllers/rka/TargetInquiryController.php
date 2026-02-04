<?php

namespace App\Http\Controllers\rka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rka\TargetInquiry;

class TargetInquiryController extends Controller
{
    public function index()
    {
        $data = TargetInquiry::all();
        return view('rka.target_inquiries.index', compact('data'));
    }

    public function create()
    {
        return view('rka.target_inquiries.create');
    }

    public function store(Request $request)
    {
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
        ]);

        return redirect()->route('rka.target-inquiries.index');
    }

    public function edit($id)
    {
        $data = TargetInquiry::findOrFail($id);
        return view('rka.target_inquiries.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = TargetInquiry::findOrFail($id);

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
        $data->delete();

        return redirect()->route('rka.target-inquiries.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
