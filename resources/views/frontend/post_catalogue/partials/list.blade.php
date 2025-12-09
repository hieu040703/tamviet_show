@php
    $suffix = config('apps.general.suffix', '');
@endphp
@foreach($posts as $post)
    @php
        $image = $post->image ? asset('storage/' . $post->image) : asset('backend/img/not-found.jpg');
        $href = $post->canonical ? url($post->canonical . $suffix)  : '#';
    @endphp
    <div  class="border-t border-neutral-200 bg-white py-3 md:rounded-md md:border-0 md:px-4">
        <div class="flex items-start justify-start space-x-2 md:border-0 md:pt-0">
            <div class="aspect-blog-image w-[92px] overflow-hidden rounded-sm md:w-[168px]">
                <a href="{{ $href }}">
                    <img
                        class="h-full w-full object-cover"
                        src="{{ $image }}"
                        alt="{{ $post->name }}"
                        loading="lazy"
                        width="500"
                        height="500">
                </a>
            </div>
            <div class="flex flex-1 flex-col">
                <a
                    class="-mt-1 mb-1 line-clamp-2 text-sm font-semibold md:text-base"
                    href="{{ $href }}">
                    <div class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink">
                        {{ $post->name }}
                    </div>
                </a>
                <div class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink line-clamp-2 text-sm md:line-clamp-3">
                    <p>{!! $post->description !!}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
