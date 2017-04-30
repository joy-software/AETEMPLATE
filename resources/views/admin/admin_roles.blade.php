
@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/deleteAside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

@endsection


@section('content')

    <section class="wrapper">

       <div class="row" >
            <div class="col-lg-offset-1 col-lg-10" style="background: white;">
                <table class="table-responsive table" style="margin-bottom : 0px;">
                    <tr>
                        <td><a class="btn btn-primary" href="/admin/">Aller a l'accueil de l'administration</a></td>
                        <td><?php if($list_users!= null) echo $list_users->links(); ?></td>
                    </tr>
                </table>

                <div id="message"></div>

                <table class="table table-responsive table-bordered">
                    <tbody>
                    <?php if($list_users == null) { ?>
                        <tr>
                            <td>Il n'y a pas de membre recensé </td>
                        </tr>
                    <?php } else {

                        foreach ($list_users as $item){
                    ?>

                        <tr id="tr_<?php echo $item['id']; ?>">
                            <td> <img src="<?php echo url('cache/logo/'. $item['photo']) ?>"> </td>
                            <td id="td_<?php echo $item['id']; ?>"> <?php echo $item['name']. " , " . $item['surname']; ?> </td>
                            <td> Promotion : <?php echo $item['promotion']. " <br>Email : ". $item['email'] . " <br> Tel : " . $item['phone']; ?> </td>
                            <td> <?php if($roles_admin[''.$item['id']. ''] == null) { ?>
                                <a class="set_admin" id="set_admin_<?php echo $item['id']?>" href="#">Affecter le droit d'administrateur d'AG</a>
                                <?php }
                                else{ echo $roles_admin[''.$item['id']. '']; }
                                ?>
                                ||
                                <?php if($roles_compta[''.$item['id']. ''] == null) { ?>
                                 <a class="set_compta" id="set_compta_<?php echo $item['id']?>" href="#">Affecter le droit de comptable</a>
                                <?php }
                                else{ echo $roles_compta[''.$item['id']. ''];
                                ?> <br><br><a class="remove_compta" id="remove_compta_<?php echo $item['id']?>" href="#">Retirer les droits de comptabilités</a>
                                <?php }
                                ?>

                            </td>
                        </tr>
                    <?php }

                    } ?>

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

    <script src="{{ asset('js/admin.js') }}"></script>

@endsection