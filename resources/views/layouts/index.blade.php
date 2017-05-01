@extends('layouts.app')
@section('title')
    Notifications
@endsection
@section('css')
    <link href="{{ asset('css/deleteAside.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="wrapper">

        <div class="row " style="margin: auto;">
            <div class=" col-md-9">
                <section  id=""  class="panel col-lg-offset-3" >
                    <header class="panel-heading">
                        <div class="row">
                            <div class=" col-md-6 " style="text-align: center">
                                <h3>Toutes vos notifications</h3>
                            </div>
                        </div>

                    </header>

                    <div id="result_Search" class=" center-block panel-body" >

                        <div class="row  col-md-12 " >

                            <div class=" col-md-12 col-lg-12 col-sm-12">
                                <table id="table_notifications" class="table table-striped table-advance table-responsive ">
                                    <tbody>
                                    @foreach($notifs->notifications()->paginate(6) as $notification)

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
                                <div class=" text-center">{{$notifs->notifications()->paginate(6)->links()}}</div>

                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    @endsection