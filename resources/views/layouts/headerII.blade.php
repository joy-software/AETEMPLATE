<header class="header white-bg">
    <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"></div>
    </div>

    <!--logo start-->
    <a href="{{ asset('karmanta/index.html') }}" class="logo">Promo<span>Vogt</span> <span class="lite">.org</span></a>
    <!--logo end-->

    <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
            <li>
                <form class="navbar-form">
                    <input class="form-control" placeholder="Search" type="text">
                </form>
            </li>
        </ul>
        <!--  search form end -->
    </div>


    <div class="top-nav notification-row">


        <ul class="nav pull-right top-menu">


            @include('layouts/menuItem', ['itemName' => 'accueil', 'link' => "/accueil" ])
            @include('layouts/menuItem', ['itemName' => 'groupes', 'link' => "/group"])
            @include('layouts/menuItem', ['itemName' => 'annuaire', 'link' => "/annuaire"])
            @include('layouts/menuItem', ['itemName' => 'bibliotheque', 'link' => "/filemanager?type=file"])
            @include('layouts/menuItem', ['itemName' => 'comptabilite', 'link' => "/#"])
            @include('layouts/menuItem', ['itemName' => 'administration', 'link' => "/#"])


           @include('layouts/menuProfil')

        </ul>

    </div>
</header>