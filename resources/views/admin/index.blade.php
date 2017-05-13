
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/deleteAside.css') }}" rel="stylesheet">

@endsection


@section('content')

    <section class="wrapper">
        <?php $role= "admin_1"; ?>
        @role($role)
        <div class="row " id="div_config" >
            <div class="col-lg-offset-1 col-lg-10" style="background: white; text-align: center;" >
                <table class="table table-responsive">
                    <!--tr>
                        <td><a class="btn btn-primary" href="#" style="width: 50%;">Publier une reunion</a></td>
                    </tr>

                    <tr>
                        <td><a class="btn btn-primary" href="#" style="width: 50%;">Modifier les configurations</a></td>
                    </tr-->

                    <tr>
                        <td><a class="btn btn-primary" href="/admin/roles" style="width: 50%;">Ajouter des comptables et administrateurs</a></td>
                    </tr>
                </table>
            </div>
        </div>
            <br>
        @endrole

        <div class="row" >
            <div class="col-lg-offset-1 col-lg-10" style="background: white;">

                <table class="table table-responsive"  style="margin-bottom : 0px;">
                    <tr>
                        <td><h3>Gestion des groupes</h3></td>
                        @role($role)
                        <td><?php if($list_group != null) echo $list_group->links(); ?></td>
                        @endrole()
                    </tr>
                </table>
                <div id="message">
                </div>
                <table class="table table-responsive">
                <tbody>
                <?php
                if($list_group != null){
                    foreach ($list_group as $item){

                ?>
                <tr id="tr_<?php echo $item['id']; ?>">
                    <td id="td_<?php echo $item['id']; ?>"><?php echo $item['name']; ?></td>
                    <td><p style="text-align: justify;"> <?php echo $item['description']; ?> </p></td>
                    <td><a class="btn btn-primary" href="/admin/suspen_user/<?php echo $item['id']; ?>" >Gerer les membres</a> | <a class="btn btn-danger btn-del" id="group<?php echo $item['id']; ?>" class="btn-del-group">Supprimer ce groupe </a> </td>
                </tr>

                <?php } }
                else {
                ?>
                <tr>
                    <td>Vous n'avez l'administration d'aucun groupe</td>
                    <td></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
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

    <script src="{{ asset('assets/js/admin.js') }}"></script>

@endsection