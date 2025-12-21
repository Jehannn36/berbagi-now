<?php

namespace App\Http\Controllers;

use App\Models\DetailDonasi;
use App\Models\Donasi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
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

    public function donasi()
    {
        $data = Donasi::where('user_id', Auth::user()->id)->get();
        $total_donasi = DetailDonasi::whereIn('donasi_id', $data->pluck('id'))->count();

        return view('app.volunteer.donasi', [
            'donasi' => $data,
            'jumlah_donasi' => $total_donasi,
        ]);
    }

    public function donasiDetail($id)
    {
        $data = DetailDonasi::where('donasi_id', $id)->get();

        return view('app.volunteer.donasi-detail', [
            'data' => $data,
        ]);
    }

    public function subscribe(Request $request)
    {
        if ($request->expired_member == 14) {
            User::where('id', Auth::user()->id)->update([
                'expired_member' => now()->addDays((int) $request->expired_member),
            ]);
        } elseif ($request->expired_member == 30) {
            User::where('id', Auth::user()->id)->update([
                'expired_member' => now()->addDays((int) $request->expired_member),
            ]);
        } else {
            User::where('id', Auth::user()->id)->update([
                'expired_member' => now()->addDays((int) $request->expired_member),
            ]);
        }

        return view('app.volunteer.dashboard');
    }

    public function create()
    {
        return view('app.volunteer.donasi-create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->expired_member !== null) {
            try {
                $validatedData = $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'judul' => 'required|string',
                    'deskripsi' => 'required|string',
                    'nomor_hp' => 'required|string',
                    'nama_rekening' => 'required|string',
                    'nomor_rekening' => 'required|string',
                    'bank' => 'required|string',
                ]);

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $filename = time().'_'.$file->getClientOriginalName();
                    $path = $file->storeAs('image', $filename, 'public');
                    $validatedData['image'] = $path;
                }

                Auth::user()->donasi()->create($validatedData);
                Auth::user()->increment('total_donation');

                return redirect('/volunteer/donasi')->with('success', 'Donasi berhasil disimpan!');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
            }
        } else {
            if (Auth::user()->total_donation == null) {
                $validatedData = $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'judul' => 'required|string',
                    'deskripsi' => 'required|string',
                    'nomor_hp' => 'required|string',
                    'nama_rekening' => 'required|string',
                    'nomor_rekening' => 'required|string',
                    'bank' => 'required|string',
                ]);

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $filename = time().'_'.$file->getClientOriginalName();
                    $path = $file->storeAs('image', $filename, 'public');
                    $validatedData['image'] = $path;
                }

                Auth::user()->donasi()->create($validatedData);
                Auth::user()->increment('total_donation');

                return redirect('/volunteer/donasi')->with('success', 'Donasi berhasil disimpan!');
            }

            return redirect()->back()->with('failed', 'Member Basic hanya dapat open donasi 1 kali. Silakan upgrade ke member premium untuk membuka donasi lebih dari 1 kali.');
        }
    }
}
