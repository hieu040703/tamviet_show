@php
    $block  = $featured_videos ?? [];
    $widget = $block['widget'] ?? null;
    $items  = collect($block['items'] ?? []);
    $block_1  = $featured_videos_1 ?? [];
    $items_1  = collect($block_1['items'] ?? []);
@endphp
@if($widget && $items->isNotEmpty())
    <div class="bg-neutral-100 h-3"></div>

    <div class="md:container md:pb-6">

        <h4 class="p-icon-1 font-semibold p-4 text-base md:px-0 md:text-[20px]">
            {{$widget->name}}
        </h4>

        <div class="brand-video md:px-0">
            @foreach($items as $item)
                <div class="brand-video-main">
                    <iframe name="{{$item->name}}" src="https://www.youtube.com/embed/{{$item->youtube_id}}" allowfullscreen></iframe>
                </div>
            @endforeach
            <div class="brand-video-side">
                @foreach($items_1 as $item_1)
                    <div class="brand-video-item">
                        <iframe name="{{$item_1->name}}" src="https://www.youtube.com/embed/{{$item_1->youtube_id}}" allowfullscreen></iframe>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <div class="bg-neutral-100 h-3"></div>
@endif
