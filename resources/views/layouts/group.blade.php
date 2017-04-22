<div class="panel panel-default">
    <div class="panel-heading">{{$groupname}}</div>
    <div class="panel-body">

        <div class="weather-category twt-category">
            <ul>
                <li class="active col-lg-3">
                    <h4>{{$nbr_event}}</h4>
                    <i class="icon_close_alt2"></i> Evènements
                </li>
                <li class="col-lg-3">
                    <h4>{{$nbr_ads}}</h4>
                    <i class="icon_check_alt2 "></i> Annonces
                </li>

                <li class="col-lg-3">
                    <h4>{{$nbr_mem}}</h4>
                    <i class="icon_plus_alt2 col-lg-3"></i> Demandes d'adhésion
                </li>
                <li>
                    <button class="btn btn-primary btnViewGroup"><a href="{{url('/group/view_group/'.$id_group)}}" style="color: white;">Voir</a></button>
                </li>
            </ul>
        </div>
    </div>

</div>