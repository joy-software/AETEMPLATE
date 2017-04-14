
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/group.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">

    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('sideOption')
    @include('layouts/asideOptionGenerated')

@endsection




@section('content')


    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="{{ route('accueil') }}"><i class="icon_house_alt"></i> Home</a></li>
                    <li><a href="/group/"> Groupes </a></li>
                    <li class="active">{{$group->name}}</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="row">
                    <div class="col-lg-8 task-progress pull-left">
                        <h1>Demande d'adhésion</h1>
                    </div>
                    <div class="col-lg-4">
                                <span class="profile-ava pull-right">
                                        <img alt="" style="width: 50px; height: auto;" class="simple" src="/{{$group->logo}}">
                                </span>
                    </div>
                </div>
            </div>
            <table class="table table-hover personal-task">
                <tbody>
                <tr>
                    <td>
                        <span class="profile-ava">
                           <img alt="" class="simple" src="img/avatar1_small.jpg">
                        </span>
                    </td>

                    <td>Rostand,<br>YOBA</td>
                    <td>
                        Promotion<br><span class="badge bg-primary">2017</span>
                    </td>
                    <td>
                        Email : <label>rostandyoba2014@gmail.com</label><br>
                        Tel : +237 690238230
                    </td>
                    <td>
                        <p style="text-align: justify;">Je suis un ancien ingénieur de l'école nationale Supérieure polytechnique de yaoundé.
                            Je suis de la promotion 2017 du Génie informatique de l'enspy.</p>
                    </td>
                    <td>

                    </td>

                </tr>

                </tbody>
            </table>
        </section>



    </section>

@endsection

@section('script')
    <script src="{{ asset('js/group.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

@endsection