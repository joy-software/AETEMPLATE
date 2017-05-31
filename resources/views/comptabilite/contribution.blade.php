@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/comptabilite.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/deleteAside.css') }}" rel="stylesheet">
    @role("comptable")
    <link href="{{ asset('assets/css/displayAside.css') }}" rel="stylesheet">
    @endrole()

@endsection
@section('title')
    Contribuer | Promot Vogt
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


@endsection
@endrole


@section('content')

    <section class="wrapper " id="wrapper-content">

        @role('comptable')
            <div  id = "inline-aside" style="display: none" class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->


                <ul class="breadcrumb" id="menu_group">
                    <li><a href="/comptabilite" ><i class="icon_house_alt"></i> Accueil des contributions </a></li>
                    <li><a href="/comptabilite/consult_contribution" ><i class="icon_search"></i> Consulter les contributions </a></li>
                    <li><a href="/comptabilite/config_momo" ><i class="icon_mobile"></i> Config Paiement Mobile </a></li>


                </ul>
                <!--breadcrumbs end -->
            </div>
        </div >
        @endrole


        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 col-md-10 col-sm-10" id="div_message">

            </div>
        </div>
            <div  style="background: white;">

                    @if($avatar->hasRole("comptable"))
                        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-5 col-sm-offset-4 col-md-offset-4" >
                     @else
                        <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-5 col-sm-offset-4 col-md-offset-4" >
                    @endif
                        <section class="panel">
                            <header class="panel-heading text-center">
                                Enregistrer une cotisation
                            </header>

                            <div class="list-group">
                                {!! Form::open(array('route' => 'post_contribution_cash', 'id'=> 'create_contribution_cash', 'method'=>'post')) !!}
                                <a class="list-group-item" style=" background: white;">Entrer l'adresse email du membre :<br><br>
                                    <input type="email" class="form-control" name="email_membre" required id="email_membre" value="{{$avatar->email}}">
                                </a>
                                <a class="list-group-item hidden" style=" background: white;" id="phone1" >Numéro de Téléphone :<br><br>
                                    <input type="phone" class="form-control" name="phone" required id="phone" value="{{$avatar->phone}}">
                                </a>
                                <a class="list-group-item" style=" background: white;">Entrer sa contribution :<br><br>
                                    <input type="number" placeholder="ex: 5000" class="form-control" required name="amount" id="amount">
                                </a>

                                <a class="list-group-item" style=" background: white;">Choissiser le motif :<br><br>

                                    <?php
                                    if($motifs != null){
                                    ?>
                                    <select class="form-control" name="motif" id="motif">
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
                                    <select class="form-control" name="periode" id="periode">
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
                                <div class="form-group " id="button_contrib">
                                    <br/>
                                    <button  id="btn_create_contribution_cash" class="btn btn-compose center-block disabled" style="width:100px;background-color: #ff2d55!important;" >Contribuer</button>
                                </div>
                                <div class="text-center hidden" id="wecashUp" >
                                    <button   href="#" id="momobutton" class='btn btn-default' style='margin-top: 10px; margin-bottom: 10px' type='submit'><img
                                                id="Button_Image" src="https://developer.mtn.cm/OnlineMomoWeb/console/uses/itg_img/buttons/MOMO_buy_now_EN.jpg"
                                                style="width : 250px; height: 100px;"   alt="OnloneMomo, le réflexe sécurité pour payer en ligne" ></button>
                                </div>
                                {!! Form::close() !!}
                            </div>

                            <!-- Modal -->
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
                    </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 col-md-10 col-sm-10" id="div_message1">

            </div>
        </div>
    </section>

@endsection



@section('script')
    <script src="{{ asset('assets/js/comptabilite.js') }}"></script>
@endsection