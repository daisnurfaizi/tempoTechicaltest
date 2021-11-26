<?php

namespace App\Http\Controllers;

use App\Models\Pengguna as ModelsPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class Pengguna extends Controller
{
    private $title = null;



    public function ListPengguna()
    {
        $listpenguna = ModelsPengguna::all();
        return view('listpenguna.index', [
            'title' => $this->title = 'list_penguna',
            'penggunas' => $listpenguna
        ]);
    }

    public function tambahPengguna()
    {
        return view('tambahpengguna.index', [
            'judul' => 'Tambah Pengguna',
            'title' => 'Tambah Pengguna',
        ]);
    }

    public function save(Request $request)
    {
        $rules = [
            'login'                => 'required|unique:pengguna|max:30|min:4',
            'email'                 => 'required|email|unique:pengguna,email|max:50',
            'pswd'              => 'required|max:100',
            'deskripsi'             => 'required|max:150'
        ];

        $messages = [
            'login.required'         => 'login wajib diisi',
            'login.unique'         => 'login Sudah digunakan',
            'login.min'              => 'login Pengguna minimal 4 karakter',
            'login.max'              => 'login pengguna maksimal 30 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'pswd.required'     => 'Password wajib diisi',
            'deskripsi.max'         => 'Deskripsi tidak boleh lebih dari 150 karakter'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $penguna = new ModelsPengguna();
        $penguna->login = $request->login;
        $penguna->pswd = Hash::make($request->password);
        $penguna->email = $request->email;
        $penguna->deskripsi = $request->deskripsi;
        $simpan = $penguna->save();
        if ($simpan) {
            return redirect('/')->with([
                'success' => $request->login,
            ]);
        }
    }

    public function delete($login)
    {
        $pengguna = ModelsPengguna::where('login', $login);
        $pengguna->delete();
        if ($pengguna) {
            return redirect('/')->with([
                'delete' => $login,
            ]);
        }
    }


    public function edit($login)
    {
        $pengguna = ModelsPengguna::where('login', $login)->first();
        // dd($pengguna->login);
        return view('editpengguna.edit', [
            'pengguna' => $pengguna,
            'judul' => 'Edit Data Pengguna',
            'title' => 'Edit Data Pengguna'
        ]);
    }



    public function update(Request $request)
    {
        $pengguna = ModelsPengguna::where('login', $request->login);
        $datapengguna = $pengguna->first();
        // dd($datapengguna->email==$request);
        if ($datapengguna->email != $request->email) {
            $rules = [
                'email'                 => 'required|unique:pengguna|email|max:50',
                'password'              => 'max:100',
                'deskripsi'             => 'required|max:150'
            ];

            $messages = [
                'email.required'        => 'Email wajib diisi',
                'email.email'           => 'Email tidak valid',
                'email.unique'          => 'Email sudah terdaftar',
                'password.max'     => 'Password maximal 100',
                'deskripsi.max'         => 'Deskripsi tidak boleh lebih dari 150 karakter'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
        } else {
            $rules = [
                'email'                 => 'required|email|max:50',
                'password'              => 'max:100',
                'deskripsi'             => 'required|max:150'
            ];

            $messages = [
                'email.required'        => 'Email wajib diisi',
                'email.email'           => 'Email tidak valid',
                // 'email.unique'          => 'Email sudah terdaftar',
                'password.max'     => 'Password maximal 100',
                'deskripsi.max'         => 'Deskripsi tidak boleh lebih dari 150 karakter'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
        }
        // dd($request->login);

        if (isset($request->password)) {
            $pengguna = ModelsPengguna::where('login', $request->login)->update(
                [
                    'pswd' => Hash::make($request->password),
                    'email' => $request->email,
                    'deskripsi' => $request->deskripsi
                ]
            );
        } else {
            $pengguna->update(
                [
                    // 'pswd' => Hash::make($request->password),
                    'email' => $request->email,
                    'deskripsi' => $request->deskripsi
                ]
            );
        }


        if ($pengguna) {
            return redirect('/')->with([
                'diubah' => $request->login,
            ]);
        }
    }
}
