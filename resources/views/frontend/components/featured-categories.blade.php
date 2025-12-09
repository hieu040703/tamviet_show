@php
    $block  = $homeCategories ?? [];
    $widget = $block['widget'] ?? null;
    $items  = collect($block['items'] ?? []);
@endphp

@if($widget && $items->isNotEmpty())
    <div>
        <div class="bg-neutral-100 h-3"></div>
        <div class="container pb-4">
            <h4 class="font-semibold p-4 px-0 text-base md:text-[20px]">
                {{ $widget->name ?? 'Danh mục nổi bật' }}
            </h4>

            <div class="grid grid-cols-2 gap-2 md:grid-cols-5 md:gap-4">
                @foreach($items as $item)
                    @php
                        $image = $item->icon ? asset('storage/'.$item->icon) : asset('backend/img/not-found.jpg');
                    @endphp

                    <a
                        class="flex items-center gap-2 rounded-lg border p-2"
                        href="{{ router_link('categories', $item->id) }}"
                    >
                        <img
                            href="{{ router_link('categories', $item->id) }}"
                            class="h-14 w-14 rounded-full object-cover"
                            src="{{ $image }}"
                            alt="{{ $item->name }}"
                            loading="lazy"
                            width="500"
                            height="500"
                        >
                        <p class="line-clamp-2 text-sm">
                            {{ $item->name }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
