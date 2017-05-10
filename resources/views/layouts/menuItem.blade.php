
<li id="{{ $itemName }}" >
    @if((session('menu') === 'groupe') && ($itemName === 'groupes'))
        <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
    @else
        @if((session('menu') === 'annuaire') && ($itemName === 'annuaire'))
            <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
        @else
            @if((session('menu') === 'compta') && ($itemName === 'comptabilite'))
                <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
            @else
                @if((session('menu') === 'admin') && ($itemName === 'administration'))
                    <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
                @else
                    @if((session('menu') === 'accueil') && ($itemName === 'accueil'))
                        <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
                    @else
                        <a data-toggle="dropdown" class="" href="{{ $link }}">
                    @endif
                @endif
            @endif
        @endif
    @endif

        <span class="welcome-label">
            @if ($itemName === 'accueil')
                Accueil
            @elseif($itemName === 'groupes')
                Groupes
            @elseif($itemName === 'annuaire')
                Annuaire
            @elseif($itemName === 'bibliotheque')
                Bibliotheque
            @elseif($itemName === 'comptabilite')
                Comptabilite
            @elseif($itemName === 'administration')
                Administration
            @endif
        </span>
    </a>
</li>

