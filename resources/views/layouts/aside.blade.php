<aside id="aside">
    <div id="sidebar"  class=" ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">


            @include('layouts/asideOption', [

                'classIconOption' => 'icon_house_alt',
                'optionName' => 'Assemblée générale',
                'retractable' => 'true',
                'subOptions' => [['link' => 'javascript:', 'name' => 'Voir les membres'],
                                 ['link' => 'javascript:', 'name' => 'Créer un évènement'],
                                 ['link' => 'javascript:', 'name' => 'Créer une annonce'],
                                 ['link' => 'javascript:', 'name' => 'Options']
                ]

            ])

            @include('layouts/asideOption', [

                'classIconOption' => 'icon_table',
                'optionName' => 'Promotion 96',
                'retractable' => 'true',
                'subOptions' => [['link' => 'javascript:', 'name' => 'Voir les membres'],
                                 ['link' => 'javascript:', 'name' => 'Créer un évènement'],
                                 ['link' => 'javascript:', 'name' => 'Créer une annonce'],
                                 ['link' => 'javascript:', 'name' => 'Options']
                ]

            ])

            @include('layouts/asideOption', [

                'classIconOption' => 'icon_piechart',
                'optionName' => 'Kongourou',
                'retractable' => 'true',
                'subOptions' => [['link' => 'javascript:', 'name' => 'Voir les membres'],
                                 ['link' => 'javascript:', 'name' => 'Créer un évènement'],
                                 ['link' => 'javascript:', 'name' => 'Créer une annonce'],
                                 ['link' => 'javascript:', 'name' => 'Options']
                ]
            ])

            @include('layouts/asideOption', [

                'classIconOption' => 'icon_documents_alt',
                'optionName' => 'Rechercher un groupe',
                'retractable' => 'false',
                'subOptions' => [['link' => 'javascript:', 'name' => 'Voir les membres'],
                                 ['link' => 'javascript:', 'name' => 'Créer un évènement'],
                                 ['link' => 'javascript:', 'name' => 'Créer une annonce'],
                                 ['link' => 'javascript:', 'name' => 'Options']
                ]
            ])

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>