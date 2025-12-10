@extends('backend.layout')

@section('content')
    <div class="col-md-12">

        <form action="{{route('admin.system.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{__("SystemLibrary")}}</h6>
                    <div class="heading-elements">
                        <button type="submit" class="btn btn-primary">
                            {{  __('Save') }}
                            <i class="icon-file-plus position-right"></i>
                        </button>
                    </div>
                </div>

                <div class="panel-body">

                    <div class="tabbable tab-content-bordered">
                        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                            @foreach($systemConfig as $key => $val)
                                <li @if($loop->index == 0) class="active" @endif><a
                                        href="#{{\Str::slug($val['label'])}}" data-toggle="tab">{{ $val['label'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="tab-content">
                        @foreach($systemConfig as $key => $val)
                            <div class="tab-pane has-padding  @if($loop->index == 0) active @endif"
                                 id="{{\Str::slug($val['label'])}}">
                                <p class="text-center">{{ $val['description'] }}</p>
                                <div class="col-md-12">
                                    <fieldset class="content-group">
                                        @if(count($val['value']))
                                            <div class="ibox-content">
                                                @foreach($val['value'] as $keyVal => $item)
                                                    @php
                                                        $name = $key.'_'.$keyVal;
                                                    @endphp
                                                    <div class="row mb15">
                                                        <div class="col-lg-12">

                                                            <label for="" class="d-flex justify-content-between">
                                                                <span>{{ $item['label'] }}</span>
                                                                {!! renderSystemLink($item) !!}
                                                                {!! renderSystemTitle($item) !!}
                                                            </label>

                                                            @switch($item['type'])
                                                                @case('text')
                                                                    {!! renderSystemInput($name, $systems) !!}
                                                                    @break
                                                                @case('images')
                                                                    {!! renderSystemImages($name, $systems) !!}
                                                                    @break
                                                                @case('textarea')
                                                                    {!! renderSystemTextarea($name, $systems) !!}
                                                                    @break
                                                                @case('select')
                                                                    {!! renderSystemSelect($item, $name, $systems) !!}
                                                                    @break
                                                                @case('editor')
                                                                    {!! renderSystemEditor($name, $systems) !!}
                                                                    @break
                                                                @case('repeater')
                                                                    {!! renderSystemRepeater($item, $name, $systems) !!}
                                                                    @break
                                                            @endswitch


                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </fieldset>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            {{  __('Save') }}
                            <i class="icon-file-plus position-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('styles')
    <style type="text/css">
        .panel-title {
            font-size: 20px;
            margin-bottom: 15px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .panel-description {
            font-size: 15px;
        }

        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
            font-weight: 700;
        }

        @media (min-width: 768px) {
            .ibox-content {
                padding: 15px 20px 20px 20px;
            }
        }

        .ibox-content {
            background-color: #ffffff;
            color: inherit;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0;
        }

        .mb15 {
            margin-bottom: 15px;
        }

        .system-link {
            font-size: 10px;
            font-weight: normal;
            font-style: italic;
        }

        .text-danger {
            color: #ed5565;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        textarea.system-textarea {
            resize: both !important;
            overflow: auto;
            width: auto !important;
            min-width: 100%;
            max-width: none;
        }
    </style>
@endpush
@push('scripts')
    @include('backend.partials.ckeditor')
    @push('scripts')
        <script>
            document.addEventListener('click', function (e) {
                if (e.target.closest('.sr-add')) {
                    const wrap = e.target.closest('.system-repeater');
                    const tbody = wrap.querySelector('.sr-rows');
                    const tpl = wrap.querySelector('.sr-template').innerHTML;
                    const idx = tbody.querySelectorAll('tr').length;
                    const html = tpl.replaceAll('__INDEX__', idx);
                    tbody.insertAdjacentHTML('beforeend', html);
                }
                if (e.target.closest('.sr-remove')) {
                    const tr = e.target.closest('tr');
                    tr.parentNode.removeChild(tr);
                }
            });
        </script>
    @endpush
@endpush
