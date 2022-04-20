<?php

namespace App\Http\Controllers;

use App\Models\fasilitasKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FasilitasKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage-fasilitas-kamar', ['fasilitas'=>fasilitasKamar::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_fasilitas' => 'required|min:2|unique:fasilitas_kamar,nama_fasilitas',
            'keterangan' => 'nullable'
        ],
        [
            'nama_fasilitas.required' => 'Nama fasilitas harus di isi',
            'nama_fasilitas.unique' => 'Nama fasilitas sudah ditambahkan',
            'nama_fasilitas.min' => 'Nama fasilitas minimal 2 karakter'
        ]);
        fasilitasKamar::create($validatedData);
        return back()->with('store', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = fasilitasKamar::findorfail($id);
        return view('admin.action.detail-fasilitas-kamar', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = fasilitasKamar::findorfail($id);
        return view('admin.action.edit-fasilitas-kamar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = fasilitasKamar::findorfail($id);
        $validatedData = $request->validate([
            'nama_fasilitas' => "required|min:2|unique:fasilitas_kamar,nama_fasilitas,{$data->id}",
            'keterangan' => 'nullable'
        ],
        [
            'nama_fasilitas.required' => 'Nama fasilitas harus di isi',
            'nama_fasilitas.unique' => 'Nama fasilitas sudah ditambahkan',
            'nama_fasilitas.min' => 'Nama fasilitas minimal 2 karakter'
        ]);
        fasilitasKamar::where('id', $id)->update($validatedData);
        return redirect('admin/manage-fasilitas-kamar')->with('update', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('fasilitas_kamar')->delete($id);
        return back()->with('delete', 'data yang anda ingin kan telah di hapus');
    }

    public function search(Request $request) {
        $keyword = $request->search;
        $kamar = kamar::where('nama_fasilitas', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.manage-fasilitas-kamar', compact('fasilitas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
