<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id){
        $profile = User::where('id', $id)->first(['name', 'email', 'expired_member', 'image']);

        if($profile->expired_member !== null){
            $profile->expired_member = 'Premium';
        }

        return view('app.profile', [
            'profile' => $profile
        ]);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image', $filename, 'public');
            $validatedData['image'] = $path;
        }

        $user->update($validatedData);

        return view('app.profile', [
            'profile' => $user
        ]);
    }

}
