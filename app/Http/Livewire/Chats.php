<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Chats extends Component
{
    public $activeChat = 0, $content;
    public $search, $nameUser, $test;


    public function render()
    {
        $userId = auth()->user()->id;
        if($this->activeChat != 0){
            $data = array(
                'users' => User::latest()
                        ->where('users.id', '<>', $userId)
                        ->where('username', 'like', '%' . $this->search . '%')
                        ->get(),
                'chats' => DB::table('chats')
                        ->select('*')
                        ->whereRaw("(sender = $userId AND recepient = $this->activeChat)")
                        ->orWhereRaw("(sender = $this->activeChat AND recepient = $userId)")
                        ->get()
            );
        }else{
            // $this->activeChat = 0;
            $this->activeChat = DB::table('chats')
                                    ->where('sender', '=', $userId)
                                    ->orderByDesc('created_at')
                                    ->first();
            if ($this->activeChat) {
                $this->activeChat = $this->activeChat->recepient;
            }else{
                $this->activeChat = 0;
            }
            $data = array(
                'users' => User::latest()
                        ->where('users.id', '<>', $userId)
                        ->where('username', 'like', '%' . $this->search . '%')
                        ->get(),
                'chats' => DB::select("SELECT * FROM chats")
            );
        }
        return view('livewire.chats', $data);
    }

    public function activeChat($id)
    {
        $this->activeChat = $id;
        $this->nameUser = User::find($id)->name;

    }

    public function store()
    {
        $userId = auth()->user()->id;
        $this->validate([
            'content' => 'required'
        ]);

        Chat::create([
            'content' => $this->content,
            'sender' => $userId,
            'recepient' => $this->activeChat
        ]);

        $this->content = '';
    }

    public function check()
    {
        $this->test = true;
    }
}
