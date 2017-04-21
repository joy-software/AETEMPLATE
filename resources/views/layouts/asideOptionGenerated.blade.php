
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
    @foreach($list_group as $list_group_el)
        @include('layouts/asideOptionII', [
            'link'=> '/group/view_group/'.$list_group_el['id'],
            'id' => $list_group_el['id'],
            'optionName' => $list_group_el['name'],
            'url_image' => $list_group_el['logo'],
            'retractable' => 'false'
            /*'subOptions' =>
                [
                    ['link'=>url('/group/view_group/'.$list_group_el['id']), 'classIconOption' => 'icon_house_alt', 'name'=>'Accueil'],
                    ['link' => url('/group/member_group/'.$list_group_el['id']), 'name' => 'Membres'],
                    ['link' => url('/group/ads_group/'.$list_group_el['id']), 'name' => 'Annonces'],
                    ['link' => url('/group/event_group/'.$list_group_el['id']), 'name' => 'Evenements'],
                    ['link' => url('/group/ballot_group/'.$list_group_el['id']), 'name' => 'Scrutin']
                ]*/
            ])

    @endforeach
@endif