
<li class="sub-menu">
    <a href="javascript:;" class="">
        <i class="{{ $classIconOption }}"></i>
        <span>{{ $optionName }}</span>

        @if($retractable === 'true')
            <span class="menu-arrow arrow_carrot-right"></span>
        @endif
    </a>
    @if($retractable === 'true')
        <ul class="sub">
            @foreach($subOptions as $subOption)
                <li><a class="" href="{{ $subOption['link'] }}">{{ $subOption['name'] }}</a></li>
            @endforeach
        </ul>
    @endif
</li>