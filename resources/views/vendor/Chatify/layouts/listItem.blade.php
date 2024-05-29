{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item m-li-divider @if('user_'.Auth::user()->id == $id && $id != "0") m-list-active @endif">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="avatar av-m" style="background-color: #D9EFFF; text-align: center;">
                    <span class="ti ti-bookmark" style="font-size: 22px; color: #6FD943;"></span>
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ 'user_'.Auth::user()->id }}">{{__('Saved Messages')}} <span>{{__('You')}}</span></p>
                <span>{{__('Save messages secretly')}}</span>
            </td>
        </tr>
    </table>
@endif

@if(!empty($user) && $user->count() > 0)
    {{-- -------------------- All users/group list -------------------- --}}
    @if($get == 'users')
        <table class="messenger-list-item @if($user->id == $id && $id != "0") m-list-active @endif" data-contact="{{ !empty($user)?$user->id:0 }}">
            <tr data-action="0">
                {{-- Avatar side --}}
                <td style="position: relative">
                    @if($user->active_status)
                        <span class="activeStatus"></span>
                    @endif
                    @if(!empty($user->avatar))
                        <div class="avatar av-m"
                             style="background-image: url('{{ \App\Models\Utility::get_file('/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}');">
                        </div>
                    @else
                        <div class="avatar av-m"
                             style="background-image: url('{{ \App\Models\Utility::get_file('/'.config('chatify.user_avatar.folder').'/avatar.png') }}');">
                        </div>
                    @endif
                </td>
                {{-- center side --}}
                @if(!empty($lastMessage))
                    <td>
                        <p data-id="{{ $type.'_'.$user->id }}">
                            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
                            <span class="chat-time">{{ !empty($lastMessage)?$lastMessage->created_at->diffForHumans():'' }}</span></p>
                        <span class="chat-msg">
            {{-- Last Message use indicator --}}
                            {!!
                                $lastMessage->from_id == Auth::user()->id
                                ? '<span class="lastMessageIndicator">You :</span>'
                                : ''
                            !!}
                            {{-- Last message body --}}
                            @if($lastMessage->attachment == null)
                                {{
                                    strlen($lastMessage->body) > 30
                                    ? trim(substr($lastMessage->body, 0, 30)).'..'
                                    : $lastMessage->body
                                }}
                            @else
                                <span class="ti ti-file"></span> Attachment
                            @endif
        </span>
                        {{-- New messages counter --}}
                        {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
                    </td>
                @else
                    <td></td>
                @endif
            </tr>
        </table>
    @endif

    {{-- -------------------- Search Item -------------------- --}}
    @if($get == 'search_item')
        <table class="messenger-list-item" data-contact="{{ $user->id }}">
            <tr data-action="0">
                {{-- Avatar side --}}
                <td style="position: relative">
                    @if($user->active_status)
                        <span class="activeStatus"></span>
                    @endif

                    @if(!empty($user->avatar))
                        <div class="avatar av-m"
                             style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}');">
                        </div>
                    @else
                        <div class="avatar av-m"
                             style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'/avatar.png') }}');">
                        </div>
                    @endif
                </td>
                {{-- center side --}}
                <td>
                    <p data-id="{{ $type.'_'.$user->id }}">
                    {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
                </td>

            </tr>
        </table>
    @endif


    {{-- -------------------- Get All Members -------------------- --}}

    @if($get == 'all_members')
        <table class="messenger-list-item" data-contact="{{ $user->id }}">
            <tr data-action="0">
                {{-- Avatar side --}}
                <td style="position: relative">
                    @if($user->active_status)
                        <span class="activeStatus"></span>
                    @endif
                    @if(!empty($user->avatar))
                        <div class="avatar av-m"
                             style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}');">
                        </div>
                    @else
                        <div class="avatar av-m"
                             style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'/avatar.png') }}');">
                        </div>
                    @endif
                </td>
                {{-- center side --}}
                <td>
                    <p data-id="{{ $type.'_'.$user->id }}">
                    {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
                </td>

            </tr>
        </table>
    @endif

@endif





{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
    <div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif


