<li id="{{ $idElement }}" class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="{{ $classIcon }}"></i>
        <span class="badge bg-important">{{ $numberNotification }}</span>
    </a>
    <ul class="dropdown-menu extended tasks-bar">
        <div class="notify-arrow notify-arrow-blue"></div>
        <li>
            <p class="blue">{{ $summary }}</p>
        </li>

        @foreach($notifications as $notification)

            <li>
                <a href="#">
                    <span class="label label-{{ $notification['typeLabel'] }}"><i class="{{ $notification['classIcon'] }}"></i></span>
                    {{ $notification['message'] }}
                    <span class="small italic pull-right"> {{ $notification['time'] }}</span>
                </a>
            </li>

        @endforeach


        <li class="external">
            <a href="#">See All Tasks</a>
        </li>
    </ul>
</li>