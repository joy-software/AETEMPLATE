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
    Contribuer | Promot-Vogt
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



            <div  style="background: white;">


                    <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-5 col-sm-offset-4 col-md-offset-4" >
                        <section class="panel">
                            <header class="panel-heading text-center">
                                Enregistrer une cotisation
                            </header>

                            <div class="list-group">
                                {!! Form::open(array('route' => 'post_contribution', 'files' => true, 'id'=> 'create_contribution', 'method'=>'post')) !!}
                                <a class="list-group-item" style=" background: white;">Entrer l'adresse email du membre :<br><br>
                                    <input type="email" class="form-control" name="email_membre" required id="email_membre" value="{{$avatar->email}}">
                                </a>
                                <a class="list-group-item" style=" background: white;">Entrer sa contribution :<br><br>
                                    <input type="number" placeholder="ex: 5000" class="form-control" required name="amount" id="amount">
                                </a>

                                <a class="list-group-item" style=" background: white;">Choissiser le motif :<br><br>

                                    <?php
                                    if($motifs != null){
                                    ?>
                                    <select class="form-control" name="motif">
                                        <?php foreach($motifs as $motif){
                                        ?>
                                        <option class="form-control" value="<?php echo $motif->id; ?>"> <?php echo $motif->reason; ?> </option>
                                        <?php }
                                        ?>
                                    </select>
                                    <?php
                                    }
                                    else {
                                    ?>
                                    Aucun Motif n'existe. Créer une période SVP
                                    <?php
                                    }
                                    ?>

                                </a>

                                <a class="list-group-item" style="background: white;">
                                    Choissisez la période : <br><br>
                                    <?php
                                    if($periodes != null){
                                    ?>
                                    <select class="form-control" name="periode">
                                        <?php foreach($periodes as $periode){
                                        ?>
                                        <option class="form-control" value="<?php echo $periode->id; ?>"> <?php echo strtoupper($periode->month)." - ".$periode->year; ?> </option>
                                        <?php }
                                        ?>
                                    </select>
                                    <?php
                                    }
                                    else {
                                    ?>
                                    Aucune période n'existe. Créer une période SVP
                                    <?php
                                    }
                                    ?>
                                </a>
                                <div class="center col-lg-offset-2 col-md-offset-2 col-sm-offset-2" >
                                   <br>
                                    <script async src="https://www.wecashup.cloud/live/2-form/js/MobileMoney.js" class="wecashup_button"
                                            data-receiver-uid={{env('WCU_IDENTIFIANT_MARCHAND')}}
                                                    data-receiver-public-key={{env('WCU_CLE_PUBLIQUE_MARCHAND')}}
                                                    data-transaction-receiver-total-amount="MONTANT_TOTAL_DE_LA_TRANSACTION"
                                            data-transaction-receiver-currency="{{env('WCU_DEVISE_DU_MARCHAND')}}"
                                            data-name={{config('app.name')}}
                                                    data-transaction-receiver-reference="REFERENCE_DE_LA_TRANSACTION_CHEZ_LE_MARCHAND"
                                            data-transaction-sender-reference="REFERENCE_DE_LA_TRANSACTION_CHEZ_LE_CLIENT"
                                            data-style="1"
                                            data-image="https://www.wecashup.cloud/live/2-form/img/home.png"
                                            data-cash="true"
                                            data-telecom="true"
                                            data-m-wallet="false"
                                            data-split="false"
                                            data-sender-lang="fr"
                                            data-sender-phonenumber="{{$avatar->phone}}">
                                    </script>
                                </div>
                                {!! Form::close() !!}
                            </div>

                        </section>
                    </div>




        </div>

        <div class="modal fade" id="ConfirmAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body" style="background: white;">
                        Exemple de modal
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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