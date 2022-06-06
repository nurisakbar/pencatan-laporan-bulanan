<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\UserCreateRequest;
use App\Activity;
use Auth;
class ActivityController extends Controller
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
        //$this->verify();
        if ($request->ajax()) {
            return \DataTables::of(Activity::all())
            ->addColumn('action', function ($activity) {
                $btn = \Form::open(['url' => 'activity/' . $activity->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/activity/' . $activity->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->rawColumns(['action','activity'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('activity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('activity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data               = $request->all();
        if ($request->hasFile('file')) {
            $file       = $request->file('file');
            $fileName   = 'file_' . time() . '.' . $file->getClientOriginalExtension();
            \Storage::putFileAs('public', $request->file('file'), $fileName);
            $data['file'] = $fileName;
        }

        $data['user_id']    = Auth::user()->id;
        Activity::create($data);
        return redirect('activity')->with('message', 'Berhasil Menambahkan Data');
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
        $data['activity']   = Activity::find($id);
        return view('activity.edit', $data);
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
        if ($activity->level == 'administrator') {
            $data['level'] = 'administrator';
        }
        $activity->update($data);
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
        Toko::where('user_id', $activity->id)->delete();
        TarikDana::where('user_id', $activity->id)->delete();
        Penjualan::where('user_id', $activity->id)->delete();
        Absensi::where('user_id', $activity->id)->delete();
        Gaji::where('user_id', $activity->id)->delete();
        $activity->delete();
        \Session::flash('message', 'Berhasil Menghapus Data Anggota');
        return redirect('user');
    }

    public function profile()
    {
        $id             = Auth::user()->id;
        $data['user']   = User::find($id);
        return view('activity.profile', $data);
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
