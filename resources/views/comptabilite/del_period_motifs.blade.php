@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/comptabilite.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/displayAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" media="print">

@endsection
@section('title')
    Suppression des périodes / motifs
@endsection
<?php $rol = "comptable"; ?>

@role($rol)
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

        <div class="row" style="background: white; margin-right: 50px; margin-left: 50px">
            <div class="col-lg-offset-1 col-lg-5">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>
                                Gerer les périodes
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  if($periodes == null ) { ?>
                        <tr>
                            <td>
                                Il n'y a aucune période
                            </td>
                        </tr>
                    <?php }
                    else {
                        foreach ($periodes as $item) {
                        ?>
                        <tr>
                            <td> <?php echo strtoupper($item['month']) . " - ".$item['year']; ?> </td>
                            <td>
                                <button class="btn btn-primary del-period" id="btn-del-period-<?php echo $item['id'] ?>">Supprimer</button>
                            </td>
                        </tr>
                    <?php }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="col-lg-5">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>
                            Gerer les Motifs
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if($motifs == null ) { ?>
                    <tr>
                        <td>
                            Il n'y a aucun motif
                        </td>
                    </tr>
                    <?php }
                    else {
                    foreach ($motifs as $item) {
                    ?>
                    <tr>
                        <td> <?php echo $item['reason']; ?> </td>
                        <td>
                            <button class="btn btn-primary del-motif" id="btn-del-motif-<?php echo $item['id'] ?>">Supprimer</button>
                        </td>
                    </tr>
                    <?php }
                    }
                    ?>
                    </tbody>
                </table>
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