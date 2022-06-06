<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\User;
use App\Toko;
use App\Group;
use App\Jabatan;
use Auth;
use App\TarikDana;
use App\Penjualan;
use App\Absensi;
use App\Gaji;
use Illuminate\Support\Facades\Hash;
use App\Exports\DataKaryawanExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function verify()
    {
        if (Auth::user()->level != 'administrator') {
            abort(404);
        }
    }

    public function index(Request $request)
    {
        $this->verify();
        if ($request->ajax()) {
            return \DataTables::of(User::with('jabatan')->get())
            ->addColumn('action', function ($user) {
                $btn = \Form::open(['url' => 'user/' . $user->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/user/' . $user->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->addColumn('toko', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->nama_toko . "<br>";
                }
                return $list;
            })
            ->addColumn('nomor_rekening', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->nomor_rekening . "<br>";
                }
                return $list;
            })
            ->addColumn('nama_bank', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->nama_bank . "<br>";
                }
                return $list;
            })
            ->addColumn('pemilik_rekening', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->pemilik_rekening . "<br>";
                }
                return $list;
            })
            ->addColumn('merchant_id', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->merchant_id . "<br>";
                }
                return $list;
            })
            ->addColumn('nomor_hp', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->nomor_hp . "<br>";
                }
                return $list;
            })
            ->addColumn('saldo_tersedia', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . rupiah($t->saldo_tersedia) . "<br>";
                }
                return $list;
            })
            ->addColumn('dana_diproses', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . rupiah($t->dana_diproses) . "<br>";
                }
                return $list;
            })
            ->addColumn('jumlah_product', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->jumlah_product . "<br>";
                }
                return $list;
            })
            ->addColumn('tanggal_update', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->tanggal_update . "<br>";
                }
                return $list;
            })
            ->addColumn('kartu_perdana', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $list .= "- " . $t->kartu_perdana . "<br>";
                }
                return $list;
            })
            ->addColumn('limit_product', function ($user) {
                $list = "";
                foreach ($user->toko as $t) {
                    $lmt = $t->limit_product == 1 ? 'Limit' : 'Tidak';

                    $list .= "- " . $lmt . "<br>";
                }
                return $list;
            })
            ->addColumn('jabatan', function ($user) {
                return $user->jabatan->nama_jabatan ?? $user->level;
            })
            ->addColumn('lama_kerja', function ($user) {
                return $user->tanggal_mulai_bekerja == '0000-00-00' ? '-' : \Carbon\Carbon::parse($user->tanggal_mulai_bekerja)->diffInMonths(date('Y-m-d')) . ' Bulan';
            })
            ->rawColumns(['action','kartu_perdana','limit_product','tanggal_update','jumlah_product','dana_diproses','saldo_tersedia','toko','merchant_id','nomor_rekening','nama_bank','pemilik_rekening','nomor_hp'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['jabatan'] = Jabatan::pluck('nama_jabatan', 'id');
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data               = $request->all();
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = 'photo' . time() . '.' . $file->getClientOriginalExtension();
            \Storage::putFileAs('public', $request->file('photo'), $fileName);
            $data['photo'] = $fileName;
        }

        $data['password']   = Hash::make($request->password);
        $data['user_id']    = Auth::user()->id;
        User::create($data);
        \Session::flash('message', 'Berhasil Menambahkan Data');
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $data['jabatan'] = Jabatan::pluck('nama_jabatan', 'id');
        $data['user']   = User::find($id);
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        if ($request->password != null) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = 'photo' . time() . '.' . $file->getClientOriginalExtension();
            \Storage::putFileAs('public', $request->file('photo'), $fileName);
            $data['photo'] = $fileName;
        }
        if ($user->level == 'administrator') {
            $data['level'] = 'administrator';
        }
        $user->update($data);
        \Session::flash('message', 'Berhasil Mengupdate Data ' . $request->name);
        if ($request->has('page')) {
            return redirect('profile');
        }
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        Toko::where('user_id', $user->id)->delete();
        TarikDana::where('user_id', $user->id)->delete();
        Penjualan::where('user_id', $user->id)->delete();
        Absensi::where('user_id', $user->id)->delete();
        Gaji::where('user_id', $user->id)->delete();
        $user->delete();
        \Session::flash('message', 'Berhasil Menghapus Data Anggota');
        return redirect('user');
    }

    public function profile()
    {
        $id             = Auth::user()->id;
        $data['user']   = User::find($id);
        return view('user.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $id             = Auth::user()->id;
        $params         = $request->only('name', 'email');
        if ($request->password != '') {
            $params["password"] = Hash::make($request->password);
        }
        User::where('id', $id)->update($params);
        \Session::flash('message', 'Data User Berhasil Di Update');
        return redirect('user/profile');
    }

    public function excel()
    {
        return Excel::download(new  DataKaryawanExport(), 'laporan-data-karyawan.xlsx');
    }

    public function dropdownJabatan(Request $request)
    {
        $jabatan = Jabatan::where('level', $request->level)->pluck('nama_jabatan', 'id');
        return \Form::select('jabatan_id', $jabatan, null, ['class' => 'form-control jabatan_id']);
    }
}
