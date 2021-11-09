<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username, $password;
    public function render()
    {
        return view('livewire.login');
    }

    public function login()
    {
        $credential = $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credential)){
            return redirect('/chat');
        }else{
            session()->flash('message', 'Wrong username/password');
        }

    }
}
