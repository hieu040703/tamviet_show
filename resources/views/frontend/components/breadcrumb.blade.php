@php
    $arrowSvg = '
        <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full h-3 w-3 text-neutral-800">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M17.2137 11.2862L8.21971 2.29524C7.82506 1.90159 7.18567 1.90159 6.79002 2.29524C6.39537 2.68889 6.39537 3.32829 6.79002 3.72194L15.0706 11.9995L6.79102 20.2771C6.39637 20.6707 6.39637 21.3101 6.79102 21.7048C7.18567 22.0984 7.82606 22.0984 8.22071 21.7048L17.2147 12.7139C17.6032 12.3243 17.6032 11.6749 17.2137 11.2862Z"
                    fill="currentColor"></path>
            </svg>
        </span>';
@endphp

<div class="hidden bg-neutral-100 md:block">
    <div class="container -mt-4">
        <div>
            <ul class="flex items-center py-1.5 text-neutral-600">
                @foreach($breadcrumb as $item)
                    <li class="h-5 text-sm">
                        <span class="hover:text-neutral-800 mx-1 font-normal text-[12px] leading-5 {{ $loop->last ? 'text-neutral-900' : '' }}">
                            @if(!empty($item['url']))
                                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                            @else
                                {{ $item['title'] }}
                            @endif
                        </span>
                        @if(!$loop->last)
                            {!! $arrowSvg !!}
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        @php
            $ldItems = [];
            foreach ($breadcrumb as $i => $item) {
                $row = [
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'name'     => $item['title'],
                ];
                if (!empty($item['url'])) {
                    $row['item'] = $item['url'];
                }
                $ldItems[] = $row;
            }

            $ldJson = json_encode([
                '@context'        => 'https://schema.org',
                '@type'           => 'BreadcrumbList',
                'itemListElement' => $ldItems,
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        @endphp

        <script type="application/ld+json">
            {!! $ldJson !!}
        </script>
    </div>
</div>
