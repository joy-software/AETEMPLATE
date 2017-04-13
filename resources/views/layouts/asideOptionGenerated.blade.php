
@include('layouts/asideOption', [

            'classIconOption' => 'icon_house_alt',
            'optionName' => 'Rechercher un groupe',
            'retractable' => 'false',
            'link' => url('/group/search_group')
        ])
@include('layouts/asideOption', [
            'classIconOption' => 'icon_house_alt',
            'optionName' => 'Créer un groupe',
            'retractable' => 'false',
            'link' => url('/group/create_group')
        ])


@if($list_group != null)
    @foreach($list_group as $group)
        @include('layouts/asideOptionII', [
            'id' => $group->id,
            'optionName' => $group->name,
            'url_image' => $group->logo,
            'retractable' => 'true',
            'subOptions' =>
                [
                    ['link'=>url('/group/view_group/'.$group->id), 'classIconOption' => 'icon_house_alt', 'name'=>'Accueil'],
                    ['link' => url('/group/member_group/'.$group->id), 'name' => 'Membres'],
                    ['link' => url('/group/ads_group/'.$group->id), 'name' => 'Annonces'],
                    ['link' => url('/group/event_group/'.$group->id), 'name' => 'Evenements'],
                    ['link' => url('/group/ballot_group/'.$group->id), 'name' => 'Scrutin']
                ]

            ])

    @endforeach
@endif