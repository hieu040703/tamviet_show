@extends('backend.layout')

@section('content')

    @include('backend.layouts.partials.page-header')

    <form action="{{ $item->id ? route('admin.widget_items.update', $item->id) : route('admin.widget_items.store', $widget->id) }}"
          method="POST">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ $title }}</h5>
                    </div>

                    <div class="panel-body">
                        {{-- Loại đối tượng --}}
                        <div class="form-group">
                            <label>Loại dữ liệu</label>
                            <select name="object_type" id="object_type" class="form-control">
                                <option value="products" {{ old('object_type', $item->object_type) == 'products' ? 'selected' : '' }}>Sản phẩm</option>
                                <option value="brands" {{ old('object_type', $item->object_type) == 'brands' ? 'selected' : '' }}>Thương hiệu</option>
                                <option value="categories" {{ old('object_type', $item->object_type) == 'categories' ? 'selected' : '' }}>Danh mục</option>
                                <option value="posts" {{ old('object_type', $item->object_type) == 'posts' ? 'selected' : '' }}>Bài viết</option>
                            </select>
                        </div>

                        {{-- Tìm kiếm bằng AJAX --}}
                        <div class="form-group">
                            <label>Tìm đối tượng</label>
                            <div class="input-group">
                                <input type="text" id="object_search" class="form-control"
                                       placeholder="Nhập từ khoá tìm kiếm...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="btn_search_object">
                                        Tìm
                                    </button>
                                </span>
                            </div>

                            <select id="object_select" class="form-control" size="5" style="margin-top: 5px;">
                                {{-- sẽ được fill bằng AJAX --}}
                            </select>

                            <input type="hidden" name="object_id" id="object_id"
                                   value="{{ old('object_id', $item->object_id) }}">
                        </div>

                        {{-- Title & Link (có thể để trống để auto) --}}
                        <div class="form-group">
                            <label>Tiêu đề (để trống sẽ lấy theo đối tượng)</label>
                            <input type="text" name="title" id="title"
                                   value="{{ old('title', $item->title) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Link (để trống sẽ lấy theo canonical)</label>
                            <input type="text" name="link" id="link"
                                   value="{{ old('link', $item->link) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Ảnh (nếu có)</label>
                            <input type="text" name="image" id="image"
                                   value="{{ old('image', $item->image) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Thứ tự</label>
                            <input type="number" name="sort_order"
                                   value="{{ old('sort_order', $item->sort_order ?? 0) }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_active"
                                    {{ old('is_active', $item->is_active ?? 1) ? 'checked' : '' }}>
                                Hoạt động
                            </label>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                Lưu <i class="icon-arrow-right14 position-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@push('scripts')
    <script>
        (function ($) {
            'use strict';

            function loadObjects() {
                var type = $('#object_type').val();
                var q    = $('#object_search').val();

                if (!type) return;

                $.ajax({
                    url: '/admin/widget-items/search',
                    type: 'GET',
                    data: { type: type, q: q },
                    success: function (res) {
                        var $select = $('#object_select');
                        $select.empty();

                        if (!res || !res.length) {
                            $select.append('<option value="">Không tìm thấy dữ liệu</option>');
                            return;
                        }

                        res.forEach(function (item) {
                            var opt = $('<option>')
                                .val(item.id)
                                .text(item.text)
                                .attr('data-link', item.link);

                            $select.append(opt);
                        });
                    },
                    error: function () {
                        alert('Có lỗi khi tải dữ liệu, vui lòng thử lại.');
                    }
                });
            }

            // click nút Tìm
            $(document).on('click', '#btn_search_object', function () {
                loadObjects();
            });

            // Enter trong ô search
            $(document).on('keypress', '#object_search', function (e) {
                if (e.which === 13) {
                    e.preventDefault();
                    loadObjects();
                }
            });

            // chọn item trong select => set object_id + auto fill title/link
            $(document).on('change', '#object_select', function () {
                var $opt = $(this).find('option:selected');
                var id   = $opt.val();
                var text = $opt.text();
                var link = $opt.data('link') || '';

                $('#object_id').val(id);

                if (!$('#title').val()) {
                    $('#title').val(text);
                }
                if (!$('#link').val() && link) {
                    $('#link').val(link);
                }
            });

        })(jQuery);
    </script>
@endpush
