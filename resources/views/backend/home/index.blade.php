@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-flat">
                <div class="panel-heading">
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-box"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">{{__("Products")}}</div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-visitors"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-newspaper"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">{{__("Posts")}}</div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-sessions"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-people"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">{{__("Users")}}</div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="total-online"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-5">
            <div class="panel panel-flat">
                <div class="panel-heading">
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-box"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">{{__("Promotions")}}</div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>
                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-sessions"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-newspaper"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">{{__("Reviews")}}</div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-flat">

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>{{__("Product")}}</th>
                            <th class="col-md-2">{{__("Category")}}</th>
                            <th class="col-md-2">{{__("Create By")}}</th>
                            <th class="col-md-2">{{__("Status")}}</th>
                            <th class="col-md-2">{{__("SKU")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active border-double">
                            <td colspan="5">{{__("Recent")}}</td>
                            <td class="text-right">
                                <span class="progress-meter" id="today-progress" data-progress="30"></span>
                            </td>
                        </tr>
                        {{--                        @forelse($products->take(10) ?? [] as $variant)--}}
                        {{--                            <tr>--}}
                        {{--                                <td>--}}
                        {{--                                    <div class="media-left media-middle">--}}
                        {{--                                        <a href="#"><img src="{{ asset($variant->product->image) }}"--}}
                        {{--                                                         class="img-circle img-xs" alt=""></a>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="media-left">--}}
                        {{--                                        <div class=""><a href="#"--}}
                        {{--                                                         class="text-default text-semibold">{{$variant->product->name}}</a>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="text-muted text-size-small">--}}
                        {{--                                            {{ __("Quantity") }}: {{ $variant->quantity }}--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </td>--}}
                        {{--                                <td><span class="text-muted">{{ $variant->product->category->name }}</span></td>--}}
                        {{--                                <td><span class="text-success-600">{{$variant->product->user->name}}</td>--}}
                        {{--                                <td><span class="label bg-blue">{{ $variant->getStatus() }}</span></td>--}}
                        {{--                                <td>{{ $variant->sku }}</td>--}}
                        {{--                            </tr>--}}
                        {{--                        @empty--}}
                        {{--                            {{__("No result")}}--}}
                        {{--                        @endforelse--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{__("Recent Activity")}}</h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>{{__("Entity")}}</th>
                            <th>{{__("Change")}}</th>
                            <th>{{__("At")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--                        @forelse($activities ?? [] as $activity)--}}
                        {{--                            <tr>--}}
                        {{--                                <td>--}}
                        {{--                                    <span  class="letter-icon-title">{{ ucfirst($activity->modelInstance()?->getTable())  }}</span>--}}
                        {{--                                    <div class="text-muted text-size-small">{{ ucfirst($activity->event->name) }}</div>--}}

                        {{--                                </td>--}}
                        {{--                                <td>--}}
                        {{--                                    <span class="text-muted text-size-small">{{ count(json_decode($activity->new_values ?? '', true) ?? []) }}</span>--}}
                        {{--                                </td>--}}
                        {{--                                <td>--}}
                        {{--                                    <span class="text-muted text-size-small">{{ $activity->created_at->diffForHumans() }}</span>--}}
                        {{--                                </td>--}}
                        {{--                            </tr>--}}
                        {{--                        @empty--}}
                        {{--                            {{__("No result")}}--}}
                        {{--                        @endforelse--}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{__("Recent Message")}}</h6>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active fade in has-padding" id="messages-tue">
                        <ul class="media-list">
                            {{--                            @forelse($conversations ?? [] as $conversation)--}}
                            {{--                                <li class="media">--}}
                            {{--                                    <div class="media-left">--}}
                            {{--                                        <img--}}
                            {{--                                            src="{{ $conversation->reciver?->profile?->avatar ? asset($conversation->reciver->profile->avatar) : 'https://api-private.atlassian.com/users/50b335ba706e5610e24fdea2b4af98f8/avatar' }}"--}}
                            {{--                                            class="img-circle img-xs"--}}
                            {{--                                            alt=""--}}
                            {{--                                        >--}}
                            {{--                                    </div>--}}

                            {{--                                    <div class="media-body">--}}
                            {{--                                        <span >--}}
                            {{--                                            {{ $conversation->receiver->name }}--}}
                            {{--                                            <span class="media-annotation pull-right">{{ $conversation?->last_message?->created_at?->format('H:m') }}</span>--}}
                            {{--                                        </span>--}}

                            {{--                                        <span class="display-block text-muted">{{ $conversation?->last_message?->content }}</span>--}}
                            {{--                                    </div>--}}
                            {{--                                </li>--}}
                            {{--                            @empty--}}
                            {{--                                {{__("No result")}}--}}
                            {{--                            @endforelse--}}
                        </ul>
                    </div>
                </div>
                <!-- /tabs content -->

            </div>
        </div>
    </div>
@endsection
