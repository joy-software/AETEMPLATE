
<li id="{{ $itemName }}" >
    @if((session('menu') === 'groupe') && ($itemName === 'groupes' || $itemName === 'groupes_tog'))
        <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
    @else
        @if((session('menu') === 'annuaire') && ($itemName === 'annuaire' || $itemName === 'annuaire_tog'))
            <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
        @else
            @if((session('menu') === 'compta') && ($itemName === 'comptabilite' || $itemName === 'comptabilite_tog'))
                <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
            @else
                @if((session('menu') === 'admin') && ($itemName === 'administration' || $itemName === 'administration_tog'))
                    <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
                @else
                    @if((session('menu') === 'accueil') && ($itemName === 'accueil' || $itemName === 'accueil_tog'))
                        <a data-toggle="dropdown" style="color: #007AFF" href="{{ $link }}">
                    @else
                        <a data-toggle="dropdown" class="" href="{{ $link }}">
                    @endif
                @endif
            @endif
        @endif
    @endif

        <span class="welcome-label">
            @if ($itemName === 'accueil' || $itemName === 'accueil_tog')
                Accueil
            @elseif($itemName === 'groupes' || $itemName === 'groupes_tog')
                Groupes
            @elseif($itemName === 'annuaire' || $itemName === 'annuaire_tog')
                Annuaire
            @elseif($itemName === 'bibliotheque' || $itemName === 'bibliotheque_tog')
                Bibliotheque
            @elseif($itemName === 'comptabilite' || $itemName === 'comptabilite_tog')
                Comptabilite
            @elseif($itemName === 'administration' || $itemName === 'administration_tog')
                Administration
            @endif
        </span>
    </a>
</li>

