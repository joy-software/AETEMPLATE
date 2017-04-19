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
                                        <tr>
                                            <td><img src="/@if($notification['data']['photo_member'] == null)users/user.png" style="height: 20%; width: auto;" alt="Photo du "{{$notification['data']['name_member'] }}>
                                                @else
                                                    {{$notification['data']['photo_member']}}" style="height: 5%; width: auto;" alt="Photo du "{{$notification['data']['name_member'] }}>
                                                @endif
                                            </td>
                                            <td>{{ $notification['data']['name_member'] . ' ' . $notification['data']['surname_member'] }} voudrait rejoindre le groupe:
                                                {{$notification['data']['name_group'] }}</td>
                                            <td><img src="/{{$notification['data']['logo_group']}}" style="height: 20%; width: auto;" alt="Photo du "{{$notification['data']['name_group'] }}></td>
                                        </tr>
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