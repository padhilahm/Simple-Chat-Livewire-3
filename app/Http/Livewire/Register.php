<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $email, $username, $password, $name;

    public function render()
    {
        return view('livewire.register');
    }

    public function register()
    {
        $this->validate([
            'username' => 'required|min:5|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required'
        ]);

        User::create([
            'username' => $this->username,
            'password' => bcrypt($this->password),
            'email' => $this->email,
            'name' => $this->name
        ]);

        $this->resetField();
        session()->flash('message', 'Account successfully created, please login');
        return redirect('/');

    }

    function resetField()
    {
        $this->email = '';
        $this->username = '';
        $this->password = '';
        $this->name = '';
    }
}
