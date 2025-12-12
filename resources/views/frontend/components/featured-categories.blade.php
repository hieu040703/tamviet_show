@php
    $block  = $homeCategories ?? [];
    $widget = $block['widget'] ?? null;
    $items  = collect($block['items'] ?? []);
@endphp

@if($widget && $items->isNotEmpty())
    <div>
        <div class="bg-neutral-100 h-3"></div>
        <div class="container pb-4 pt-4">
            <div class="grid grid-cols-2 gap-2 md:grid-cols-6 md:gap-4">
                @foreach($items as $item)
                    @php
                        $image = $item->icon
                            ? asset('storage/'.$item->icon)
                            : asset('backend/img/not-found.jpg');
                    @endphp

                    <a
                        href="{{ router_link('categories', $item->id) }}"
                        class="flex flex-col items-center gap-2 rounded-lg border p-3 text-center hover:shadow-sm transition"
                    >
                        <img
                            class="h-16 w-16 rounded-full object-cover"
                            src="{{ $image }}"
                            alt="{{ $item->name }}"
                            loading="lazy"
                        >

                        <p class="p-icon-1 line-clamp-2 text-sm font-semibold text-neutral-800">
                            {{ $item->name }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
<div class="bg-neutral-100 h-3"></div>
