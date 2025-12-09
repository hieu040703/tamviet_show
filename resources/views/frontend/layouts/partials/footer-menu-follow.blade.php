@php
    $menu = isset($menu) ? $menu : null;
    $parents = $menu ? $menu->items : collect();
    $normalize = function ($value) {
        return mb_strtolower(trim($value), 'UTF-8');
    };
    $aboutGroup = $parents->first(function ($item) use ($normalize) {
        return $normalize($item->name) === $normalize('Về Tâm Việt');
    });
    $categoryGroup = $parents->first(function ($item) use ($normalize) {
        return $normalize($item->name) === $normalize('Danh mục');
    });
    $socialGroup = $parents->first(function ($item) use ($normalize) {
        return $normalize($item->name) === $normalize('Theo dõi chúng tôi trên');
    });
    $iconMap = [
        'facebook' => URL::asset('frontend/assets/image/social/facebook.svg'),
        'youtube'  => URL::asset('frontend/assets/image/social/youtube.svg'),
        'zalo'     => URL::asset('frontend/assets/image/social/zalo.svg'),
        'tiktok'   => URL::asset('frontend/assets/image/social/tiktok.svg'),
    ];
@endphp

<div class="grid grid-cols-2 gap-1 gap-y-4 md:grid-cols-4 md:gap-2">
    @if($aboutGroup)
        <div>
            <h4 class="text-[14px] leading-[20px] mb-4 font-bold">{{ $aboutGroup->name }}</h4>
            <ul>
                @foreach($aboutGroup->children as $item)
                    <li class="pb-2">
                        <a href="{{ router_link_from_canonical(optional($item->router)->canonical) }}"
                           target="{{ $item->target ?: '_self' }}">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($categoryGroup)
        <div>
            <h4 class="text-[14px] leading-[20px] mb-4 font-bold">{{ $categoryGroup->name }}</h4>
            <ul>
                @foreach($categoryGroup->children as $item)
                    <li class="pb-2">
                        <a href="{{ router_link_from_canonical(optional($item->router)->canonical) }}">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($socialGroup)
        <div>
            <h4 class="text-[14px] leading-[20px] mb-4 font-bold">{{ $socialGroup->name }}</h4>
            <ul>
                @foreach($socialGroup->children as $item)
                    @php
                        $nameLower = mb_strtolower(trim($item->name));
                        $iconKey = null;
                        if (strpos($nameLower, 'facebook') !== false) {
                            $iconKey = 'facebook';
                        } elseif (strpos($nameLower, 'youtube') !== false) {
                            $iconKey = 'youtube';
                        } elseif (strpos($nameLower, 'zalo') !== false) {
                            $iconKey = 'zalo';
                        } elseif (strpos($nameLower, 'tiktok') !== false) {
                            $iconKey = 'tiktok';
                        }
                        $iconPath = $iconKey ? ($iconMap[$iconKey] ?? null) : null;
                    @endphp

                    <li class="pb-4">
                        <a class="flex" href="{{ $item->url ?: '#' }}" target="_blank">
                            @if($iconPath)
                                <img class="mr-2 w-6" src="{{ asset($iconPath) }}" alt="{{ $item->name }}">
                            @endif
                            {{ $item->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(isset($system['contact_hotline']))
        <div>
            <h4 class="text-[14px] leading-[20px] mb-4 font-bold">Tổng đài chăm sóc khách hàng</h4>
            <p>Hỗ trợ đặt hàng</p>
            <a href="tel:{{$system['contact_hotline']}}"
               class="block pt-2 font-bold text-primary-500">{{$system['contact_hotline']}}</a>
        </div>
    @endif

</div>
