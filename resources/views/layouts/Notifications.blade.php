<a data-toggle="dropdown" class="dropdown-toggle" href="#" >
    <i class="{{ $classIcon }}"></i>
    @if($numberNotification > 0 )
        <span class="badge bg-important">{{ $numberNotification }}</span>
    @endif
</a>
<ul class="dropdown-menu extended tasks-bar" style="min-width: 500px !important">
    <div class="notify-arrow notify-arrow-blue"></div>
    <div  style="width: 500px !important" id="table_notifications">
        <table  class="table table-striped table-advance table-responsive "  style="width:100%; margin: auto !important;">
            <thead>
            <tr>
                <th></th>
                <th> <p class="blue">@if($numberNotification <= 1)
                            Vous avez {{$numberNotification}} message non lue
                        @else
                            Vous avez {{$numberNotification}} messages non lues
                        @endif</p></th>
                <th></th>

                <th><i class="icon_action"></i></th>
            </tr>
            </thead>
            <tbody>

            @foreach($notifications as $notification)
                @if($notification['type']  === 'App\Notifications\IncomingMember')
                    <tr class='clickable-row' data-href='{{url('group/view_group/'.$notification['data']['id_group'])}}'>
                        <td><img src="
                                {{url('/imagecache/logo/'.$notification['data']['photo_member'])}}"  alt="Photo du "{{$notification['data']['name_member'] }}>
                        </td>
                        @if($notification['data']['id_group'] == 1)
                            <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} se reclame comme étant un ancien vogtois.</td>
                        @else
                            <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} voudrait rejoindre le groupe:
                                {{$notification['data']['name_group'] }}</td>
                        @endif
                        <td><img src="{{url('/imagecache/logo/'.$notification['data']['logo_group'])}}"  alt="Photo du "{{$notification['data']['name_group'] }}></td>
                        <td></td>
                    </tr>
                @endif
                @if($notification['type']  === 'App\Notifications\InformOthersInvitationAccepted')
                    <tr class='clickable-row' data-href='{{url('group/view_group/'.$notification['data']['id_group'])}}'>
                        <td><img src="
                                {{url('/imagecache/logo/'.$notification['data']['photo_member'])}}" alt="Photo du "{{$notification['data']['name_member'] }}>
                        </td>
                        @if($notification['data']['id_group'] == 1)
                            <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} vient d'intégrer l'association.</td>
                        @else
                            <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} vient d'intégrer le groupe:
                                {{$notification['data']['name_group'] }}</td>
                        @endif
                        <td><img src="{{url('/imagecache/logo/'.$notification['data']['logo_group'])}}" style="height: 8%; width: auto;" alt="Photo du "{{$notification['data']['name_group'] }}></td>
                        <td></td>
                    </tr>
                @endif
                @if($notification['type']  === 'App\Notifications\NewAnnouncement')
                    <tr class='clickable-row' data-href='{{url('group/ads_group/'.$notification['data']['id_group'])}}'>
                        <td><img src="
                                {{url('/imagecache/logo/'.$notification['data']['photo_member'])}}"  alt="Photo du "{{$notification['data']['name_member'] }}>
                        </td>
                        @if($notification['data']['id_group'] == 1)
                            <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} vient de publier une annonce dans l'association.</td>
                        @else
                            <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} vient de publier une annonce dans le groupe:
                                {{$notification['data']['name_group'] }}</td>
                        @endif
                        <td><img src="{{url('/imagecache/logo/'.$notification['data']['logo_group'])}}" style="height: 8%; width: auto;" alt="Photo du "{{$notification['data']['name_group'] }}></td>
                        <td></td>
                    </tr>
                @endif
                @if($notification['type']  === 'App\Notifications\NewEvent')
                    <tr class='clickable-row' data-href='{{url('group/event_group/'.$notification['data']['id_group'])}}'>
                        <td><img src="{{url('/imagecache/logo/'.$notification['data']['photo_member'])}}" alt="Photo du "{{$notification['data']['name_member'] }}>
                        </td>
                        @if($notification['data']['id_group'] == 1)
                            <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} vient de publier un évènement l'association.</td>
                        @else
                            <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} vient de publier un évènement dans le groupe:
                                {{$notification['data']['name_group'] }}</td>
                        @endif
                        <td><img src="{{url('/imagecache/logo/'.$notification['data']['logo_group'])}}"  alt="Photo du "{{$notification['data']['name_group'] }}></td>
                        <td></td>
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