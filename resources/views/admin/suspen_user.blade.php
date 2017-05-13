
@extends('layouts/app')

@section('css')

    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/deleteAside.css') }}" rel="stylesheet">

@endsection

@section('title')
    Suspendre des membres
@endsection

@section('content')

    <section class="wrapper">

       <div class="row" >
            <div class="col-lg-offset-1 col-lg-10" style="background: white;">
                <table class="table-responsive table">
                    <tr>
                        <td><label style="font-size: 1.5em;">Suspendre des membres de <strong>" {{ $group->name }} "</strong></label></td>
                        <td><a class="btn btn-primary" href="/admin/">Aller à l'accueil de l'administration</a></td>
                    </tr>
                </table>

                <div id="message"></div>
                <table class="table table-responsive">
                    <tbody>
                    <?php if($list_users == null) { ?>
                        <tr>
                            <td>Il n'y a pas d'autres membres dans ce groupe </td>
                        </tr>
                    <?php } else {

                        foreach ($list_users as $item){
                    ?>
                    <input type="hidden" value="<?php echo $group->id ?>" id="id_group">
                        <tr id="tr_<?php echo $item['id']; ?>">
                            <td> <img src="<?php echo url('cache/logo/'. $item['photo']) ?>"> </td>
                            <td id="td_<?php echo $item['id']; ?>"> <?php echo $item['name']. " , " . $item['surname']; ?> </td>
                            <td> Promotion : <?php echo $item['promotion']. " <br>Email : ". $item['email'] . " <br> Tel : " . $item['phone']; ?> </td>
                            <td> <?php if($roles[''.$item['id']. ''] == null) { ?>
                                <button class="btn btn-danger btn-suspen" id="user_suspen_<?php echo $item['id']?>">Suspendre</button> | <button class="btn btn-primary btn-admin" id="user_admin_<?php echo $item['id'];?>">Le definir Administrateur</button>
                                <?php }
                                else{ echo $roles[''.$item['id']. '']; }
                                ?>
                            </td>
                        </tr>

                    <?php } } ?>

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