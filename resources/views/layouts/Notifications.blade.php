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

            @foreach($user->unreadnotifications()->paginate(6) as $notification)
            <tr>
                <td><img src="/@if($notification['data']['photo_member'] == null)users/user.png" style="height: 8%; width: auto;" alt="Photo du "{{$notification['data']['name_member'] }}>
                    @else
                    {{$notification['data']['photo_member']}}" style="height: 5%; width: auto;" alt="Photo du "{{$notification['data']['name_member'] }}>
                    @endif
                </td>
                <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} voudrait rejoindre le groupe:
                    {{$notification['data']['name_group'] }}</td>
                <td><img src="/{{$notification['data']['logo_group']}}" style="height: 8%; width: auto;" alt="Photo du "{{$notification['data']['name_group'] }}></td>
                <td></td>
            </tr>
            @endforeach
            </tbody>

        </table>

        <li class="external">
            <a href="{{route('notifications')}}" style="font-size: 15px;text-align: center!important;">Voir toutes les notifications</a>
        </li>
    </div>

</ul>