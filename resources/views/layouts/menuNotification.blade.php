<li id="{{ $idElement }}" class="dropdown" >
    <a data-toggle="dropdown" id="notif-toggle" class="dropdown-toggle" href="#" >
        <i class="{{ $classIcon }}"></i>
        @if($numberNotification > 0 )
            <span class="badge bg-important">{{ $numberNotification }}</span>
        @endif
    </a>
    @if($numberNotification <= 4)
        <ul class="dropdown-menu extended tasks-bar " style="min-width: 450px!important;max-height: 375px!important;">
    @else
                <ul class="dropdown-menu extended tasks-bar " style="min-width: 450px!important;max-height: 375px!important;
    overflow-y: auto;">
    @endif

        <div class="notify-arrow notify-arrow-blue"></div>
        <div   id="table_notifications">
            <table   class="table table-striped table-advance table-responsive ">
                <thead>
                <tr>
                    <th class=" text-center"><i class="icon_chat"></i></th>
                    <th> <p class="blue text-center">@if($numberNotification <= 1)
                                Vous avez {{$numberNotification}} message non lue
                            @else
                                Vous avez {{$numberNotification}} messages non lues
                            @endif</p></th>
                    <th class=" text-center"><i class="icon_chat"></i></th>


                </tr>
                </thead>
                <tbody>

                @foreach($notifications as $notification)

                    @if($notification['type']  === 'App\Notifications\IncomingMember')
                        <tr class='clickable-row' data-href='{{url('group/view_group/'.$notification['data']['id_group'])}}'>
                            <td><img src="
                                {{url('/cache/logo/'.$notification['data']['photo_member'])}}"  alt="Photo du "{{$notification['data']['name_member'] }}>
                            </td>
                            <td class="text-center">
                                @if($notification['data']['id_group'] == 1)
                                    <div class="top">{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} se reclame comme étant un ancien vogtois.</div>
                                @else
                                    <div class="top">{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} voudrait rejoindre le groupe:
                                        {{$notification['data']['name_group'] }}</div>
                                @endif
                                <div class="bottom ">{{$notification->created_at->format('l jS \\of F Y h:i:s A')}}</div>
                            </td>
                            <td><img src="{{url('/cache/logo/'.$notification['data']['logo_group'])}}"  alt="Photo du "{{$notification['data']['name_group'] }}></td>
                        </tr>
                    @endif
                    @if($notification['type']  === 'App\Notifications\InformOthersInvitationAccepted')
                        <tr class='clickable-row' data-href='{{url('group/view_group/'.$notification['data']['id_group'])}}'>
                            <td><img src="
                                {{url('/cache/logo/'.$notification['data']['photo_member'])}}" alt="Photo du "{{$notification['data']['name_member'] }}>
                            </td>
                            <td class="text-center">
                                @if($notification['data']['id_group'] == 1)
                                    <div class="top">{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} vient d'intégrer l'association.</div>
                                @else
                                    <div class="top">{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} vient d'intégrer le groupe:
                                        {{$notification['data']['name_group'] }}</div>
                                @endif
                                <div class="bottom ">{{$notification->created_at->format('l jS \\of F Y h:i:s A')}}</div>
                            </td>
                            <td><img src="{{url('/cache/logo/'.$notification['data']['logo_group'])}}"  alt="Photo du "{{$notification['data']['name_group'] }}></td>
                        </tr>
                    @endif
                    @if($notification['type']  === 'App\Notifications\NewAnnouncement')
                        <tr class='clickable-row' data-href='{{url('group/ads_group/'.$notification['data']['id_group'])}}'>
                            <td><img src="
                                {{url('/cache/logo/'.$notification['data']['photo_member'])}}"  alt="Photo du "{{$notification['data']['name_member'] }}>
                            </td>
                            <td class="text-center">
                                @if($notification['data']['id_group'] == 1)
                                    <div class="top">{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} a publié une annonce dans l'association.</div>
                                @else
                                    <div class="top">{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} a publié une annonce dans le groupe:
                                        {{$notification['data']['name_group'] }}</div>
                                @endif
                                <div class="bottom ">{{$notification->created_at->format('l jS \\of F Y h:i:s A')}}</div>
                            </td>
                            <td><img src="{{url('/cache/logo/'.$notification['data']['logo_group'])}}"  alt="Photo du "{{$notification['data']['name_group'] }}></td>
                        </tr>
                    @endif
                    @if($notification['type']  === 'App\Notifications\NewEvent')
                        <tr class='clickable-row' data-href='{{url('group/event_group/'.$notification['data']['id_group'])}}'>
                            <td><img src="
                                {{url('/cache/logo/'.$notification['data']['photo_member'])}}" alt="Photo du "{{$notification['data']['name_member'] }}>
                            </td>
                            <td class="text-center">
                                @if($notification['data']['id_group'] == 1)
                                    <div class="top">{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} a publié un évènement l'association.</div>
                                @else
                                    <div class="top">{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} a publié un évènement dans le groupe:
                                        {{$notification['data']['name_group'] }}</div>
                                @endif
                                <div class="bottom ">{{$notification->created_at->format('l jS \\of F Y h:i:s A')}}</div>
                            </td>
                            <td><img src="{{url('/cache/logo/'.$notification['data']['logo_group'])}}"  alt="Photo du "{{$notification['data']['name_group'] }}></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>

            </table>

            <li class="external">
                <a href="{{route('notifications')}}" style="font-size: 15px;text-align: center!important;">Voir toutes les notifications</a>
            </li>
        </div>

    </ul>
</li>