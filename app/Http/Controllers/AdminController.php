<?php

namespace App\Http\Controllers;

use App\Models\DetailDonasi;
use App\Models\Donasi;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $volunteer = User::where('role', 'volunteer')->count();
        $donasi = Donasi::count();
        $donatur = DetailDonasi::count();

        return view('app.admin.dashboard', [
            'volunteer' => $volunteer,
            'donasi' => $donasi,
            'donatur' => $donatur,
        ]);
    }

    public function volunteer()
    {
        $data = User::where('role', 'volunteer')->get();

        return view('app.admin.volunteer', [
            'data' => $data,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $data = Donasi::where('user_id', $id)->get();
        $jumlah_donasi = DetailDonasi::whereIn('donasi_id', $data->pluck('id'))->sum('nominal_donasi');

        return view('app.admin.volunteer-detail', [
            'user' => $user,
            'data' => $data,
            'jumlah_donasi' => $jumlah_donasi,
        ]);
    }
}
