<div id="frame">
    
    <div id="sidepanel">
        <div id="profile">
            <div class="wrap">
                <img id="profile-img" src="/images/no_profile.png" class="online" alt="" />
                <p>{{ auth()->user()->name }}</p>
                <div class="text-right">@livewire('logout')</div> 
                {{-- <a ><i class="fa fa-chevron-down expand-button" aria-hidden="true"></i></a> --}}
                
                <div id="status-options">
                    <ul>
                        <li id="status-online" class="active"><span class="status-circle"></span>
                            <p>Online</p>
                        </li>
                        <li id="status-away"><span class="status-circle"></span>
                            <p>Away</p>
                        </li>
                        <li id="status-busy"><span class="status-circle"></span>
                            <p>Busy</p>
                        </li>
                        <li id="status-offline"><span class="status-circle"></span>
                            <p>Offline</p>
                        </li>
                    </ul>
                </div>
                <div id="expanded">
                    {{-- <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
                    <input name="twitter" type="text" value="{{ auth()->user()->name }}" />
                    <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label> --}}
                    {{-- <input name="twitter" type="text" value="ross81" /> --}}
                    <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
                    {{-- <input name="twitter" type="text" value="mike.ross" /> --}}
                    @livewire('logout')
                </div>
            </div>
        </div>
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input wire:model="search" type="text" placeholder="Search contacts..." />
        </div>
        <div id="contacts">
            <ul>
                @foreach ($users as $user)
                <li wire:click.prevent='activeChat({{ $user->id }})' class="contact @if ($user->id == $activeChat)
                    active
                @endif">
                    <div class="wrap">
                        <span class="contact-status online"></span>
                        <img src="/images/no_profile.png" alt="" />
                        <div class="meta">
                            <p class="name">{{ $user->name }}</p>
                            <p class="preview"></p>
                        </div>
                    </div>
                </li>
                @endforeach
                
                {{-- <li class="contact active">
                    <div class="wrap">
                        <span class="contact-status busy"></span>
                        <img src="/images/no_profile.png" alt="" />
                        <div class="meta">
                            <p class="name">Harvey Specter</p>
                            <p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their
                                bluff. Or, you do any one of a hundred and forty six other things.</p>
                        </div>
                    </div>
                </li> --}}
                
            </ul>
        </div>
        <div id="bottom-bar">
            <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add
                    contact</span></button>
            <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
        </div>
    </div>
    <div class="content">
        <div class="contact-profile">
            <img src="/images/no_profile.png" alt="" />
            <p>{{ $nameUser }}</p>
            <div class="social-media">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </div>
        </div>
        <div class="messages">
            <ul>
                {{-- <li class="sent">
                    <img src="/images/no_profile.png" alt="" />
                    <p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
                </li>
                <li class="replies">
                    <img src="/images/no_profile.png" alt="" />
                    <p>When you're backed against the wall, break the god damn thing down.</p>
                </li> --}}
                @if ($activeChat != 0)
                <div wire:poll.750ms="check">
                </div>
                
                @foreach ($chats as $chat)
                <li class="@if ($chat->sender == auth()->user()->id)
                    sent
                @else
                    replies
                @endif">
                    <img src="/images/no_profile.png" alt="" />
                    <p>{{ $chat->content }}</p>
                </li>
                @endforeach
                    
                @endif
                
            </ul>
        </div>
        @if ($activeChat != false)
        <div class="message-input">
            <div class="wrap">
                <input wire:model='content' wire:keydown.enter='store' type="text" placeholder="Write your message..." />
                <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                <button wire:click.prevent='store' class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>
        @endif
    </div>
</div>