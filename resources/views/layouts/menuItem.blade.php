<li id="{{ $itemName }}" class="active">
    <a data-toggle="dropdown" class="" href="#">
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