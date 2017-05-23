<div class="panel panel-default" >
    <div class="panel-heading">{{$groupname}}</div>
    <div class="panel-body">

        <div class="weather-category twt-category">
            <ul>
                <li class="active col-lg-3 col-sm-3">
                    <h4>{{$nbr_event}}</h4>
                    <i class="icon_calendar"></i> Evènements
                </li>
                <li class="col-lg-3 col-sm-3">
                    <h4>{{$nbr_ads}}</h4>

                    <i class="icon_chat "></i> Annonces

                </li>

                <li class="col-lg-3 col-sm-3">
                    <h4>{{$nbr_mem}}</h4>

                    <i class="icon_profile"></i> Demandes d'adhésion


                </li>
                <li>
                    <a class="btn btn-primary btnViewGroup" href="{{url('/group/view_group/'.$id_group)}}" style="color: white;">Voir</a>
                </li>
            </ul>
        </div>
    </div>

</div>