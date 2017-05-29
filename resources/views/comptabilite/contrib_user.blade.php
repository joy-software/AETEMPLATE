@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/comptabilite.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/css/deleteAside.css') }}" rel="stylesheet">
    @role("comptable")
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">
    @endrole()
    <link href="{{ asset('assets/css/print.css') }}" rel="stylesheet" media="print">
@endsection
@section('title')
    Contribution de {{ $nom_user }}, Promot-Vogt
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
           'classIconOption' => 'icon_mobile',
           'optionName' => 'Config Paiement Mobile',
           'retractable' => 'false',
           'link' => url('/comptabilite/config_momo')
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
        <div class="row" id="menu_contrib_user">
            <div class="col-lg-offset-1 col-lg-10" >
                <!--breadcrumbs start -->
                <ul class="breadcrumb" style="background: white;">
                    <li><a id="btn-return-search-contrib " href="/accueil"><i class="icon_house_alt"></i> Aller l'accueil </a></li>
                    @role('comptable')
                    <li><a id="btn-return-search-contrib " href="/annuaire"></i> Aller à l'annuaire </a></li>
                    <li><a id="btn-return-search-contrib " href="/comptabilite/consult_contribution"></i> Retourner au filtre des contributions </a></li>
                    @endrole
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">

            <div class="col-lg-offset-1 col-lg-10" style="background: white;">

            <section class="panel">
                <div class="panel-body progress-panel">

                    <div class="row">
                        <div class="col-lg-6 task-progress pull-left">
                            <h1>Contribution de {{ $nom_user }} </h1>
                        </div>
                        <div class="col-lg-6" >
                            <span class="pull-right" style="margin-left: 10px;" ><button class="btn btn-primary disabled" id="imprimer_contrib" onclick="window.print();">Imprimer mes contributions </button></span>
                            @if($id == Auth::id())
                                <span><a id="btn-contrib" href="{{url('comptabilite/contribution')}}"  class="btn btn-danger pull-right disabled " style="background-color: #ff2d55!important;">Contribuer </a></span>
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
    <script>


        _token = $('input[name=_token]').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });



    </script>
    <script src="{{ asset('assets/js/comptabilite.js') }}"></script>

@endsection