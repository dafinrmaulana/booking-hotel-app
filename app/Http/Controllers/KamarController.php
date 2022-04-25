<?php

namespace App\Http\Controllers;

use App\Models\kamar;
use App\Models\fasilitasKamar;
use App\Models\fasilitasKamarStore;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamar = kamar::paginate(10);
        $fasilitas = fasilitasKamar::all();
        return view('admin.manage-kamars', compact('kamar', 'fasilitas'));
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
        $request->validate([
            'nama_kamar'=>'required|min:3|max:20|unique:kamar|not_regex:/[0-9!@#$%^&*]/',
            'jumlah'=>'required|numeric|integer|min:1|not_regex:/[a-zA-z ]/',
            'harga'=>'required|numeric|min:100000|not_regex:/[a-zA-z ]/',
            'foto'=>'required|image|mimes:jpg,png,jpeg|max:10240',
        ],
        [
            'nama_kamar.required'=>'Nama perlu diisi',
            'nama_kamar.min'=>'Minimal 3 karakter',
            'nama_kamar.max'=>'Maksimal 20 karakter',
            'nama_kamar.unique'=>'Nama kamar sudah ditambahkan',
            'nama_kamar.not_regex'=>'Nama kamar tidak boleh mengandung angka ataupun karakter spesal(!@#$%^&*])',
            'jumlah.required'=>'jumlah kamar perlu diisi',
            'jumlah.numeric'=>'Jumlah kamar harus berupa angka !',
            'jumlah.integer'=>'Jumlah kamar harus berupa angka !',
            'jumlah.min'=>'Jumlah kamar minimal 1',
            'jumlah.not_regex'=>'Jumlah kamar tidak boleh mengandung huruf',
            'harga.required'=>'Harga kamar perlu diisi',
            'harga.min'=>'Harga kamar minimal Rp. 100.000(Untuk field nya mohon untuk tidak gunakan . titik)',
            'harga.not_regex'=>'Harga kamar harus berupa angka !',
            'harga.numeric'=>'Harga kamar harus berupa angka !',
            'harga.integer'=>'Harga kamar harus berupa angka !',
            'foto.required'=>'Foto perlu diisi',
            'foto.image'=>'foto harus berupa gambar!',
            'foto.mimes'=>'foto harus ber ekstensi file jpg,png,jpeg',
            'foto.max'=>'Maksimal ukuran foto 10MB',
        ]);
        $name = $request->foto;
        $nameFile =time().rand(100, 999).".".$name->getClientOriginalExtension();

        $kamar = $request->all();
        $kamar['foto']=$nameFile;

        $name->move(public_path().'/img/kamar', $nameFile);
        $kamar = kamar::create($kamar);
        $kamar->fasilitas()->attach($request->input('fasilitasKamar_id'));
        return back()->with('store', 'store');
    }

    public function search(Request $request) {
        $keyword = $request->search;
        $fasilitas = kamar::all();
        $kamar = kamar::where('nama_kamar', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.manage-kamars', compact('kamar', 'fasilitas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = kamar::with('fasilitas')->where('id', $id)->first();
        $faska = fasilitasKamar::all();
        return view('admin.action.detail-kamars', compact('data','faska'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = kamar::findorfail($id);
        $fasilitas = fasilitasKamar::all();
        return view('admin.action.edit-kamar', compact('data', 'fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kamar = kamar::findorfail($id);
        $request->validate([
            'nama_kamar'=>"required|min:3|max:20|unique:kamar,nama_kamar,{$kamar->id}|not_regex:/[0-9!@#$%^&*]/",
            'jumlah'=>'required|numeric|integer|min:1|not_regex:/[a-zA-z ]/',
            'harga'=>'required|numeric|integer|min:100000|not_regex:/[a-zA-z ]/',
            'foto'=>'nullable|image|mimes:jpg,png,jpeg|max:10240',
            'keterangan'=>'nullable',
        ],
        [
            'nama_kamar.required'=>'Nama perlu diisi',
            'nama_kamar.min'=>'Minimal 3 karakter',
            'nama_kamar.max'=>'Maksimal 20 karakter',
            'nama_kamar.unique'=>'Nama kamar sudah ditambahkan',
            'nama_kamar.not_regex'=>'Nama kamar tidak boleh mengandung angka ataupun karakter spesal(!@#$%^&*])',
            'jumlah.required'=>'jumlah kamar perlu diisi',
            'jumlah.numeric'=>'Jumlah kamar harus berupa angka !',
            'jumlah.integer'=>'Jumlah kamar harus berupa angka !',
            'jumlah.min'=>'Jumlah kamar minimal 1',
            'jumlah.not_regex'=>'Jumlah kamar tidak boleh mengandung huruf',
            'harga.required'=>'Harga kamar perlu diisi',
            'harga.min'=>'Harga kamar minimal Rp. 100.000(Untuk field nya mohon untuk tidak gunakan . titik)',
            'harga.not_regex'=>'Harga kamar harus berupa angka !',
            'harga.numeric'=>'Harga kamar harus berupa angka !',
            'harga.integer'=>'Harga kamar minimal Rp. 100.000(Untuk field nya mohon untuk tidak gunakan . titik)',
            'foto.required'=>'Foto perlu diisi',
            'foto.image'=>'foto harus berupa gambar!',
            'foto.mimes'=>'foto harus ber ekstensi file jpg,png,jpeg',
            'foto.max'=>'Maksimal ukuran foto 10MB',
        ]);
        if ( $kamar->foto && $request->foto) {
            if(file_exists("img/kamar/".$kamar->foto)) {
                unlink("img/kamar/".$kamar->foto);
            }
        }

        if($request->foto) {
            $namaFile = time().rand(100, 999).".". $request->foto->getClientOriginalExtension();
            $request->foto->move('img/kamar/',$namaFile);
            $data = [
                'nama_kamar'=>$request->nama_kamar,
                'jumlah'=>$request->jumlah,
                'harga'=>$request->harga,
                'keterangan'=>$request->keterangan,
                'foto'=>$namaFile,
            ];
        } else if ($request->fasilitasKamar_id) {
            $data = [
                'nama_kamar'=>$request->nama_kamar,
                'jumlah'=>$request->jumlah,
                'harga'=>$request->harga,
                'keterangan'=>$request->keterangan,
            ];
            $kamar->update($data);
            $kamar->fasilitas()->sync($request->input('fasilitasKamar_id'));
        } else {
            $data = [
                'nama_kamar'=>$request->nama_kamar,
                'jumlah'=>$request->jumlah,
                'harga'=>$request->harga,
                'keterangan'=>$request->keterangan,
            ];
        }

        $kamar->update($data);
        return redirect('admin/manage-kamar')->with('update', 'sip data berhsil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kamar = kamar::findorfail($id);
        if($kamar->foto) {
            $file = 'img/kamar/'.$kamar->foto;
            if(file_exists($file)){
                unlink($file);
            }
        }
        kamar::where('id', $id)->delete();
        return back()->with('delete', 'Oke data berhasil di hapus');
    }
}
