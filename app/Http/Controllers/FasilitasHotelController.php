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
<<<<<<< HEAD
        //
=======
        $fasilitas = fasilitasHotel::paginate(10);
        return view('admin.manage-fasilitas-hotel', compact('fasilitas'));
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        //
=======
        abort(404);
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function store(Request $request)
    {
        //
=======

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_fasilitas_hotel' => 'required|not_regex:/[0-9!@#$%^&*()]/|unique:fasilitas_hotel,nama_fasilitas_hotel',
            'foto' => 'required',
            'keterangan' => 'nullable'
        ],
        [
            'nama_fasilitas_hotel.required'=>'Nama harus diisi !',
            'nama_fasilitas_hotel.not_regex'=>'Nama tidak boleh mengandung angka ataupun karakter spesial(!@#$%^&*)',
            'nama_fasilitas_hotel.unique'=>'Nama sudah ada !',
            'foto.required'=>'Foto harus diisi !'
        ]);
        $namaAsal = $request->foto;
        $namaBaru = time().rand(100, 999).".".$namaAsal->getClientOriginalExtension();

        $validatedData = $request->all();
        $validatedData['foto']=$namaBaru;

        $namaAsal->move(public_path().'/img/fasilitasHotel', $namaBaru);
        fasilitasHotel::create($validatedData);
        return back()->with('store', 'store');
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function show(fasilitasHotel $fasilitasHotel)
    {
        //
=======
    public function show($id)
    {
        $data = fasilitasHotel::find($id);
        return view('admin.action.detail-fasilitas-hotel', compact('data'));
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
    }

    /**
     * Show the form for editing the specified resource.
<<<<<<< HEAD
     *
     * @param  \App\Models\fasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function edit(fasilitasHotel $fasilitasHotel)
    {
        //
=======
     *  
     * @param  \App\Models\fasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = fasilitasHotel::find($id);
        return view('admin.action.edit-fasilitas-hotel', compact('data'));
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function update(Request $request, fasilitasHotel $fasilitasHotel)
    {
        //
=======
    public function update(Request $request, $id)
    {
        $fasilitasHotel = fasilitasHotel::findorfail($id);
        $request->validate([
            'nama_fasilitas_hotel' => "required|not_regex:/[0-9!@#$%^&*]/|unique:fasilitas_hotel,nama_fasilitas_hotel, {$fasilitasHotel->id}",
            'foto' => 'nullable',
            'keterangan' => 'nullable'
        ],
        [
            'nama_fasilitas_hotel.required'=>'Nama harus diisi !',
            'nama_fasilitas_hotel.not_regex'=>'Nama tidak boleh mengandung angka ataupun karakter spesial(!@#$%^&*)',
            'nama_fasilitas_hotel.unique'=>'Nama sudah ada !',
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
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function destroy(fasilitasHotel $fasilitasHotel)
    {
        //
=======
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
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
    }
}
