@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/comptabilite.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" media="print">
    <link href="{{ asset('css/deleteAside.css') }}" rel="stylesheet">

@endsection
@section('title')
    Contribution de {{ $nom_user }}
@endsection



@role("comptable")
@section('sideOption')
    @include('layouts/asideOption', [
                'classIconOption' => 'icon_house_alt',
                'optionName' => 'Accueil des contributions',
                'retractable' => 'false',
                'link' => url('/comptabilite')
            ])

    @include('layouts/asideOption', [
            'classIconOption' => 'icon_search',
            'optionName' => 'Consulter les contributions',
            'retractable' => 'false',
            'link' => url('/comptabilite/consult_contribution')
        ])

    @include('layouts/asideOption', [
            'classIconOption' => 'icon_download',
            'optionName' => 'Exporter des rapports',
            'retractable' => 'false',
            'link' => url('/comptabilite/export_contribution')
        ])

@endsection
@endrole


@section('content')

    <section class="wrapper" id="wrapper-content">

        <div class="row">

            <div class="col-lg-offset-1 col-lg-10" style="background: white;">
            <section class="panel">
                <div class="panel-body progress-panel">
                    <div class="row">
                        <div class="col-lg-8 task-progress pull-left">
                            <h1>Contribution de {{ $nom_user }} </h1>
                        </div>
                        <div class="col-lg-4">
                            <span class="pull-right" ><button class="btn btn-primary" id="imprimer_contrib" onclick="window.print();">Imprimer mes contributions </button></span>
                            @if($id == Auth::id())
                                <span><button  class="btn btn-danger " style="background-color: #ff2d55!important;">Contribuer </button></span>
                            @endif
                        </div>
                    </div>
                </div>
                <table class="table table-hover personal-task">
                    <tbody>
                    <?php
                            if($motifs == null){ //contribution vide
                                ?>
                                <tr><td style="text-align: left">Vous n'avez aucune contribution </td></tr>
                            <?php }
                            else {
                                for($i = 0 ; $i < $compteur ; $i++){

                                    ?>
                                   <tr>
                                       <td><?php echo $periodes[''. $i .''];?></td>

                                       <td><?php echo $motifs[''.$i.''];?></td>

                                       <td><?php echo $montant[''.$i.''];?></td>
                                   </tr>
                        <?php
                                }

                            }
                    ?>
                    </tbody>
                </table>
            </section>
            </div>

        </div>


    </section>

@endsection



@section('script')

    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/collapse.js') }}"></script>
    <script>


        _token = $('input[name=_token]').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });



    </script>
    <script src="{{ asset('js/comptabilite.js') }}"></script>

@endsection