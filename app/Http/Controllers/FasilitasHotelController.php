<?php

namespace App\Http\Controllers;

use App\Models\fasilitasHotel;
use Illuminate\Http\Request;

class FasilitasHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fasilitas = fasilitasHotel::paginate(10);
        return view('admin.manage-fasilitas-hotel', compact('fasilitas'));
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
            'nama_fasilitas_hotel' => 'required|not_regex:/[0-9!@#$%^&*()]/|unique:fasilitas_hotel,nama_fasilitas_hotel',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:10240',
            'keterangan' => 'nullable'
        ],
        [
            'nama_fasilitas_hotel.required'=>'Nama harus diisi !',
            'nama_fasilitas_hotel.not_regex'=>'Nama tidak boleh mengandung angka ataupun karakter spesial(!@#$%^&*)',
            'nama_fasilitas_hotel.unique'=>'Nama sudah ada !',
            'foto.required'=>'Foto harus diisi !',
            'foto.image'=>'foto harus berupa gambar!',
            'foto.mimes'=>'foto harus ber ekstensi file jpg,png,jpeg',
            'foto.max'=>'Maksimal ukuran foto 10MB',
        ]);
        $namaAsal = $request->foto;
        $namaBaru = time().rand(100, 999).".".$namaAsal->getClientOriginalExtension();

        $validatedData = $request->all();
        $validatedData['foto']=$namaBaru;

        $namaAsal->move(public_path().'/img/fasilitasHotel', $namaBaru);
        fasilitasHotel::create($validatedData);
        return back()->with('store', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = fasilitasHotel::find($id);
        return view('admin.action.detail-fasilitas-hotel', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = fasilitasHotel::find($id);
        return view('admin.action.edit-fasilitas-hotel', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fasilitasHotel = fasilitasHotel::findorfail($id);
        $request->validate([
            'nama_fasilitas_hotel' => "required|not_regex:/[0-9!@#$%^&*]/|unique:fasilitas_hotel,nama_fasilitas_hotel, {$fasilitasHotel->id}",
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:10240',
            'keterangan' => 'nullable'
        ],
        [
            'nama_fasilitas_hotel.required'=>'Nama harus diisi !',
            'nama_fasilitas_hotel.not_regex'=>'Nama tidak boleh mengandung angka ataupun karakter spesial(!@#$%^&*)',
            'nama_fasilitas_hotel.unique'=>'Nama sudah ada !',
            'foto.image'=>'foto harus berupa gambar!',
            'foto.mimes'=>'foto harus ber ekstensi file jpg,png,jpeg',
            'foto.max'=>'Maksimal ukuran foto 10MB',
        ]);
        if ( $fasilitasHotel->foto && $request->foto) {
            if(file_exists("img/fasilitasHotel/".$fasilitasHotel->foto)) {
                unlink("img/fasilitasHotel/".$fasilitasHotel->foto);
            }
        }

        if($request->foto) {
            $namaFile = time().rand(100, 999).".". $request->foto->getClientOriginalExtension();
            $request->foto->move('img/fasilitasHotel/',$namaFile);
            $data = [
                'nama_fasilitas_hotel'=>$request->nama_fasilitas_hotel,
                'keterangan'=>$request->keterangan,
                'foto'=>$namaFile,
            ];
        } else {
            $data = [
                'nama_fasilitas_hotel'=>$request->nama_fasilitas_hotel,
                'keterangan'=>$request->keterangan,
            ];
        }
        $fasilitasHotel->update($data);
        return redirect('admin/manage-fasilitas-hotel')->with('update', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fasilitasHotel = fasilitasHotel::findorfail($id);
        if($fasilitasHotel->foto) {
            $file = 'img/fasilitasHotel/'.$fasilitasHotel->foto;
            if(file_exists($file)){
                unlink($file);
            }
        }
        fasilitasHotel::where('id', $id)->delete();
        return back()->with('delete', 'Oke data berhasil di hapus');
    }

    public function search(Request $request) {
        $keyword = $request->search;
        $fasilitas = fasilitasHotel::where('nama_fasilitas_hotel', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.manage-fasilitas-hotel', compact('fasilitas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
