<div class="breadcrumb-line" style="margin-top: 48px;">
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('admin.backend.home') }}">
                <i class="icon-home2 position-left"></i> Home
            </a>
        </li>

        @if(isset($breadcrumb))
            @foreach($breadcrumb as $stt => $value)
                @php
                    $url = isset($value['params'])
                        ? route($value['route'], $value['params'])
                        : route($value['route']);
                @endphp

                @if($stt == (count($breadcrumb) - 1))
                    <li class="active">{!! $value['name'] !!}</li>
                @else
                    <li><a href="{{ $url }}">{{ $value['name'] }}</a></li>
                @endif
            @endforeach
        @endif
    </ul>
</div>
