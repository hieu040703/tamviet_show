
@if($menu && $menu->items)
    @foreach($menu->items as $item)
        <a rel="noopener noreferrer"
           class="grid grid-flow-col items-center justify-start gap-1"
           href="{{$item->url ??'#'}}">
            <p title="Giới Thiệu" class="truncate">{{$item->name}}</p>
            <div class="relative h-4 w-8">
                <img class="object-cover"
                     src="{{asset('frontend/assets/image/post/new.png')}}"
                     alt="{{$item->name}}"
                     loading="lazy"
                     sizes="(max-width: 768px) 6rem, 6rem">
            </div>
        </a>

    @endforeach
@endif
