
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">


@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection




@section('content')


    <section class="wrapper">
        <div class="row">
            <div class="col-lg-offset-1 col-xs-offset-1 col-sm-offset-1 col-lg-10 col-sm-10 col-xs-10">

                <section class="panel">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">

                                <div class="col-sm-offset-1 col-lg-10 col-sm-10 profile-widget-name">
                                    <h3>{{$group->name}}</h3>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3">
                                                <img style="width: 100%; height: auto;" src="{{url('cache/logo/'.$group->logo)}}" alt="Logo du groupe">
                                        </div>

                                        <div class="col-lg-7 col-sm-7">
                                            <p style="text-align: justify">
                                                {{$group->description}}
                                            </p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <footer class="profile-widget-foot" style="background: white;">
                                <div class="follow-task">
                                        {!! Form::open([
                                                'method' => 'post',
                                                'route' => 'valid_invitation_group'
                                            ]) !!}

                                    <input type="hidden" name="id_group" value="{{$group->id}}">
                                            {!! Form::submit('Envoyer une demande d\'adhésion a ce groupe', ['class' => 'btn btn-primary']) !!}
                                        {!! Form::close() !!}

                                </div>

                            </footer>

                    </div>
                </section>

            </div>
                <!--user profile info end-->
        </div>


    </section>

@endsection

@section('script')
    <script src="{{ asset('assets/js/group.js') }}"></script>
@endsection