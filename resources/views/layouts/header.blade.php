<header class="header white-bg">


    <div class="toggle-nav containers">
        <i class="icon_menu toggle-menus"></i>

        <a href="" class="logo icon-"  id="logo_home">Promot<span>Vogt</span> <span class="lite">.org</span></a>

        <ul class="navs">

            @include('layouts/menuItem', ['itemName' => 'accueil_tog', 'link' => "/accueil" ])
            @include('layouts/menuItem', ['itemName' => 'groupes_tog', 'link' => "/group"])
            @include('layouts/menuItem', ['itemName' => 'annuaire_tog', 'link' => "/annuaire"])
            @include('layouts/menuItem', ['itemName' => 'bibliotheque_tog', 'link' => "/filemanager?type=file"])
            @include('layouts/menuItem', ['itemName' => 'comptabilite_tog', 'link' => "/comptabilite"])
            @if( session('role_admin') == "true")
                @include('layouts/menuItem', ['itemName' => 'administration_tog', 'link' => "/admin"])
            @endif

            @include('layouts/menuItem', ['itemName' => 'notifications_tog', 'link' => "/notifications"])

            @include('layouts/menuProfil')


        </ul>

    </div>


    <div class="top-nav notification-row">


        <ul class="nav pull-right top-menu">


            @include('layouts/menuItem', ['itemName' => 'accueil', 'link' => "/accueil" ])
            @include('layouts/menuItem', ['itemName' => 'groupes', 'link' => "/group"])
            @include('layouts/menuItem', ['itemName' => 'annuaire', 'link' => "/annuaire"])
            @include('layouts/menuItem', ['itemName' => 'bibliotheque', 'link' => "/filemanager?type=file"])
            @include('layouts/menuItem', ['itemName' => 'comptabilite', 'link' => "/comptabilite"])
            @if( session('role_admin') == "true")
                @include('layouts/menuItem', ['itemName' => 'administration', 'link' => "/admin"])
            @endif

            @include('layouts/menuNotification',
             [
                'idElement' => 'alert_notificatoin_bar',
                'classIcon' => 'icon-bell-l',
                'numberNotification' => $nbr_notif,
                'notifications' => $user
             ])

           @include('layouts/menuProfil')

        </ul>

    </div>
</header>
