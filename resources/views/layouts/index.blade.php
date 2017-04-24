@extends('layouts.app')
@section('title')
    Notifications
@endsection
@section('css')
    <link href="{{ asset('css/deleteAside.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="wrapper">

        <div class="row">
            <div class="col-md-12">
                <section  id=""  class="panel">
                    <header class="panel-heading">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6 col-md-offset-3" style="text-align: center">
                                <h3>Toutes vos notifications</h3>
                            </div>
                        </div>

                    </header>

                    <div id="result_Search" class="panel-body" >

                        <div class="row col-md-offset-1 col-md-10 col-md-offset-1" >

                            <div class="col-md-offset-2 col-md-10 ">
                                <table id="table_notifications" class="table table-striped table-advance table-responsive "  style="width:100%; margin: auto !important;">
                                    <tbody>

                                    @foreach($user->notifications()->paginate(4) as $notification)
                                        @if($notification['type']  === 'App\Notifications\IncomingMember')
                                            <tr class='clickable-row' data-href='{{url('group/view_group/'.$notification['data']['id_group'])}}'>
                                                <td><img src="{{url('/imagecache/logo/'.$notification['data']['photo_member'])}}"  alt="Photo du "{{$notification['data']['name_member'] }}>
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
                                                <td><img src="{{url('/imagecache/logo/'.$notification['data']['photo_member'])}}" alt="Photo du "{{$notification['data']['name_member'] }}>
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
                                                <td><img src="{{url('/imagecache/logo/'.$notification['data']['photo_member'])}}"  alt="Photo du "{{$notification['data']['name_member'] }}>
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

                                {{$user->notifications()->paginate(4)->links()}}
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    @endsection