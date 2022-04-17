<?php

namespace App\Http\Controllers;

use App\Models\about;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = about::all();
        return view('admin.manage-about', compact('about'));
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
            'about'=>'required',
            'foto'=>'required'
        ],
        [
            'about.required'=>'About harus diisi !',
            'foto.required'=>'Foto harus diisi !',
        ]);
        $name = $request->foto;
        $nameFile =time().rand(100, 999).".".$name->getClientOriginalExtension();

        $about = $request->all();
        $about['foto']=$nameFile;

        $name->move(public_path().'/img/about', $nameFile);
        $about = about::create($about);
        return back()->with('store', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function show(about $about)
    {
        $data = about::first();
        return view('admin.action.detail-about', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(about $about)
    {
        $data = about::first();
        return view('admin.action.edit-about', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $about = about::findorfail($id);
        $request->validate([
            'about'=>'nullable|min:3',
            'foto'=>'nullable'
        ],
        [
            'about.min'=>'Minimal 3 karakter',
            'foto.required'=>'Foto harus diisi !',
        ]);
        if ( $about->foto && $request->foto) {
            if(file_exists("img/about/".$about->foto)) {
                unlink("img/about/".$about->foto);
            }
        }

        if($request->foto) {
            $namaFile = time().rand(100, 999).".". $request->foto->getClientOriginalExtension();
            $request->foto->move('img/about/',$namaFile);
            $data = [
                'about'=>$request->about,
                'foto'=>$namaFile,
            ];
        } else {
            $data = [
                'about'=>$request->about,
            ];
        }

        $about->update($data);
        return redirect('admin/manage-about')->with('update', 'sip data berhsil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = about::findorfail($id);
        if($about->foto) {
            $file = 'img/about/'.$about->foto;
            if(file_exists($file)){
                unlink($file);
            }
        }
        about::where('id', $id)->delete();
        return back()->with('delete', 'Oke data berhasil di hapus');
    }
}
