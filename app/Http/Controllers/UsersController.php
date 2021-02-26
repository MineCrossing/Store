<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    public function index() {
        $user = User::where('id', Auth::user()->id)->first();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('auth.account', compact('user', 'orders'));
    }

    public function show(Order $order) {
        if(Auth::user()->id == $order->user_id) {
            return view('auth.show', compact('order'));
        } else {
            return redirect()->back()->with('error', 'You do not own this ticket!');
        }
    }

    public function edit(User $user) {
        if(Auth::user() && Auth::user()->id == $user->id) {
            $user = User::find(Auth::user()->id);
            if($user) {
                return view('auth.edit', compact('user'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request, User $user) {
        if(Auth::user()->id == $user->id) {
            // dd($request);
            if(isset($request->passwordnew)) {
                $data = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'password' => 'required|password',
                    'passwordnew' => 'required|min:8|string'
                ]);

                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['passwordnew']),
                ]);

                return view('auth.account');
            } else {
                $data = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                ]);
                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]);
                return redirect()->route('users.index');
            }
        } else {
            return redirect()->back();
        }
    }
}
