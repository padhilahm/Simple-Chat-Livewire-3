<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Chat extends Component
{
    public $activeChat;
    public $search;

    public function render()
    {
        $user_id = auth()->user()->id;
        $data = array(
            'users' => User::latest()
                    ->where('users.id', '<>', $user_id)
                    ->where('username', 'like', '%' . $this->search . '%')
                    ->get(),
        );
        return view('livewire.chat', $data);
    }

    public function activeChat($id)
    {
        $this->activeChat = $id;
    }
}
