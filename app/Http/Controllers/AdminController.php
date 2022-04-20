<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage-admin', ['admin'=>admin::orderBy('role')->paginate(10) ]);
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
            'nama'=>'required|min:4|Max:50|not_regex:/[0-9!@#$%^&*()_+=]/',
            'username'=>'required|min:6|Max:50|unique:admin,username|not_regex:/[!@#$%^&*()_+= A-Z]/',
            'password'=>'required|min:6|max:20|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'role'=>'required',
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
            'password.regex'=>'Password minimal mengandung 1 angka, 1 huruf biasa dan 1 huruf kapital',
            'password.required'=>'Password Harus diisi',
            'password.min'=>'Password Minimal 6 karakter',
            'password.max'=>'Password Maksimal 20 karakter',
            'password.confirmed'=>'Password tidak sama dengan field konfirmasi password',
        ]);

        $admin = $request->all();
        $admin['password']= bcrypt($request->input('password'));
        $admin['remember_token']= Str::random(40);
        admin::create($admin);

        return back()->with('store', 'Data Admin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = admin::findorfail($id);
        return view('admin.action.detail-admin', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = admin::findorfail($id);
        return view('admin.action.edit-admin', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = admin::findorfail($id);
        $request->validate([
            'nama'=>"required|min:4|Max:50|not_regex:/[0-9!@#$%^&*()_+=]/",
            'username'=>"required|min:6|Max:50|not_regex:/[!@#$%^&*()_+= A-Z]/|unique:admin,username,{$data->id}",
            'password'=>'|nullable|min:6|max:20|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'role'=>'required',
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
            'password.same'=>'password tidak sama dengan field konfirmasi password',
            'password.regex'=>'Password minimal mengandung 1 angka, 1 huruf biasa dan 1 huruf kapital',
            'pw_confirm.min'=>"Minimal 6 karakter",
        ]);
        if($request->password) {
            $data = [
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'nama' => $request->nama,
                'role' => $request->role,
            ];
        } else {
            $data = [
                'username' => $request->username,
                'nama' => $request->nama,
                'role' => $request->role,
            ];
        }
        admin::where('id', $id)->update($data);
        return redirect('admin/manage-admin')->with('update', 'Mantap data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('admin')->delete($id);
        return back()->with('delete', 'data yang anda ingin kan telah di hapus');
    }
    
    public function search(Request $request) {
        $keyword = $request->search;
        $admin = admin::where('nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.manage-admin', compact('admin'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

}
