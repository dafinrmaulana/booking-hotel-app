<?php

namespace App\Http\Controllers;

use App\Models\tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage-tamu', ['tamu'=>tamu::paginate(10)]);
    }

    public function search(Request $request) {
        $keyword = $request->search;
        $tamu = tamu::where('nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.manage-tamu', compact('tamu'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            'nama'=>'nullable|min:3|not_regex:/[0-9!@#$%^&*]/',
            'username'=>'nullable|min:3|not_regex:/[!@#$%^&* ]/|unique:tamu,username',
            'email'=>'required|email|min:3|unique:tamu,email',
            'no_hp'=>'required|max:15|min:10|not_regex:/[a-zA-Z!@#$%^&*]/',
            'password'=>'required|min:6|max:1024|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
        ],
        [
            'nama.required'=>'Nama tamu perlu diisi',
            'nama.min'=>'Nama tamu minimal 3 karakter',
            'nama.not_regex'=>'Nama tamu tidak boleh mengandung angka ataupun karakter spesial(!@#$%^&*)',
            'username.required'=>'Username perlu diisi',
            'username.min'=>'Username minimal 3 karakter',
            'username.not_regex'=>'Nama tamu tidak boleh mengandung spasi ataupun karakter spesial(!@#$%^&*)',
            'email.required'=>'Email perlu diisi',
            'email.email'=>'Format harus berupa email',
            'email.min'=>'Email minimal 3 karakter',
            'email.unique'=>'Email sudah terdaftar',
            'password.required'=>'Password Harus diisi',
            'password.min'=>'Minimal 6 karakter',
            'password.max'=>'Maksimal 1024 karakter',
            'password.confirmed'=>'Password tidak sama dengan konfirmasi password',
            'password.regex'=>'Password minimal mengandung 1 angka, 1 huruf biasa dan 1 huruf kapital',
            'no_hp.required'=>'Nomor Hp Harus diisi',
            'no_hp.max'=>'Maksimal 15 digit',
            'no_hp.min'=>'Minimal 10 digit',
            'no_hp.not_regex'=>'Tidak boleh ada huruf ataupun karakter spesial(!@#$%^&*)',
        ]);
        $tamu = $request->all();
        $tamu['password']= bcrypt($request->input('password'));
        $tamu['remember_token']= Str::random(40);
        tamu::create($tamu);
        return back()->with('store', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tamu  $tamu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.action.detail-tamu', ['data'=>tamu::findorfail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tamu  $tamu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.action.edit-tamu', ['data'=>tamu::findorfail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tamu  $tamu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = tamu::findorfail($id);
        $request->validate([
            'nama'=>'nullable|min:3|not_regex:/[0-9!@#$%^&*]/',
            'username'=>"nullable|min:3|not_regex:/[!@#$%^&* ]/|unique:tamu,username,{$data->id}",
            'email'=>"required|email|min:3|unique:tamu,email,{$data->id}",
            'no_hp'=>'required|max:15|min:10|not_regex:/[a-zA-Z!@#$%^&*]/',
            'password'=>'nullable|min:6|max:1024|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
        ],
        [
            'nama.required'=>'Nama Harus diisi',
            'nama.min'=>'Nama Minimal 4 karakter',
            'nama.max'=>'Nama Maksimal 50 karakter',
            'nama.not_regex'=>"Nama tidak boleh mengandung angka atau pun karakter spesial(#?!@$%^&*)",
            'username.required'=>'username Harus diisi',
            'username.min'=>'username Minimal 6 karakter',
            'username.max'=>'username Maksimal 50 karakter',
            'username.unique'=>'username sudah di daftarkan',
            'username.not_regex'=>"username tidak boleh mengandung spasi atau pun karakter spesial(#?!@$%^&*)",
            'password.min'=>'password Minimal 6 karakter',
            'password.max'=>'password Maksimal 20 karakter',
            'password.confirmed'=>'password tidak sama dengan field konfirmasi password',
            'password.regex'=>'Password minimal mengandung 1 angka, 1 huruf biasa dan 1 huruf kapital',
            'no_hp.required'=>'Nomor Hp Harus diisi',
            'no_hp.max'=>'Maksimal 15 digit',
            'no_hp.min'=>'Minimal 10 digit',
            'no_hp.not_regex'=>'Tidak boleh ada huruf ataupun karakter spesial(!@#$%^&*)',
        ]);
        if($request->password) {
            $data = [
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'nama' => $request->nama,
                'email'=>$request->email,
                'no_hp'=>$request->no_hp,
                'remember_token'=>Str::random(40)
            ];
        } else {
            $data = [
                'username' => $request->username,
                'nama' => $request->nama,
                'email'=>$request->email,
                'no_hp'=>$request->no_hp,
            ];
        }
        tamu::where('id', $id)->update($data);
        return redirect('admin/manage-tamu')->with('update', 'Mantap data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tamu  $tamu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tamu')->delete($id);
        return back()->with('delete','destroy');
    }
}
