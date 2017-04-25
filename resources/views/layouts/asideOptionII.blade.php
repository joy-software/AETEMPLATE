
<li class="sub-menu">
    <a href="{{ $link }}" class=""  id="{{ $id }}">
        <span><img style="width: 25px; height: 25px;" src="{{url('cache/original/'.$url_image)}}" alt="Logo du groupe : {{ $optionName }}" > {{ $optionName }}</span>

        @if($retractable === 'true')
            <span class="menu-arrow arrow_carrot-right"></span>
        @endif
    </a>
    @if($retractable === 'true')
        <ul class="sub">
            @foreach($subOptions as $subOption)
                <li><a class="" href="{{ $subOption['link'] }}">
                        @if(isset($subOption['classIconOption']))
                        <i class="{{ $subOption['classIconOption'] }}"></i>
                        @endif
                        {{ $subOption['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>