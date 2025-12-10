<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\PostCatalogue;
use App\Models\Post;

if (!function_exists('renderSystemLink')) {
    function renderSystemLink(array $item = [], $systems = null)
    {
        return (isset($item['link'])) ? '<a class="system-link" target="' . $item['link']['target'] . '" href="' . $item['link']['href'] . '">' . $item['link']['text'] . '</a>' : '';
    }
}
if (!function_exists('renderSystemTitle')) {
    function renderSystemTitle(array $item = [], $systems = null)
    {
        return (isset($item['title'])) ? '<span class="system-link text-danger">' . $item['title'] . '</span>' : '';
    }
}
if (!function_exists('renderSystemInput')) {
    function renderSystemInput(string $name = '', $systems = null)
    {
        $value = old($name, is_object($systems) ? ($systems->{$name} ?? '') : ($systems[$name] ?? ''));

        return '<input
            type="text"
            name="config[' . $name . ']"
            value="' . htmlspecialchars($value) . '"
            class="form-control"
            placeholder=""
            autocomplete="off"
        >';
    }
}
if (!function_exists('renderSystemImages')) {
    function renderSystemImages(string $name = '', $systems = null)
    {
        $value = is_object($systems) ? ($systems->{$name} ?? '') : ($systems[$name] ?? '');
        $html  = '<input
            type="file"
            name="config[' . $name . ']"
            class="form-control"
            accept="image/*"
        >';
        if (!empty($value)) {
            $url = \Illuminate\Support\Str::startsWith($value, ['http://', 'https://'])
                ? $value
                : asset('storage/' . $value);
            $html .= '<p class="help-block" style="margin-top:5px;">
                        Đã lưu: <code>' . e($value) . '</code><br>
                        <a href="' . e($url) . '" target="_blank">Xem ảnh</a>
                      </p>';
        }
        return $html;
    }
}



if (!function_exists('renderSystemTextarea')) {
    function renderSystemTextarea(string $name = '', $systems = null)
    {
        $value = old($name, is_object($systems) ? ($systems->{$name} ?? '') : ($systems[$name] ?? ''));

        return '<textarea name="config[' . $name . ']" class="form-control system-textarea">'
            . htmlspecialchars($value) .
            '</textarea>';
    }
}
if (!function_exists('renderSystemSelect')) {
    function renderSystemSelect(array $item, string $name = '', $systems = null)
    {
        $selectedValue = is_object($systems) ? ($systems->{$name} ?? '') : ($systems[$name] ?? '');

        $html = '<select name="config[' . $name . ']" class="form-control">';
        foreach ($item['option'] as $key => $val) {
            $selected = $key == $selectedValue ? 'selected' : '';
            $html .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
        }
        $html .= '</select>';

        return $html;
    }
}
if (!function_exists('renderSystemEditor')) {
    function renderSystemEditor(string $name = '', $systems = null)
    {
        $value = old($name, is_object($systems) ? ($systems->{$name} ?? '') : ($systems[$name] ?? ''));

        return '<textarea
                    name="config[' . $name . ']"
                    id="content"
                    class="form-control system-textarea ck-editor"
                >'
            . htmlspecialchars($value) .
            '</textarea>';
    }
}

if (!function_exists('renderSystemRepeater')) {
    function renderSystemRepeater(array $item, string $name, array $systems): string
    {
        $stored = $systems[$name] ?? '[]';
        $rows = is_array($stored) ? $stored : (json_decode($stored, true) ?: []);
        if (!is_array($rows) || !count($rows)) $rows = $item['seed'] ?? [];

        $fields = $item['fields'] ?? [];
        $columns = $item['columns'] ?? [];
        $root = 'config[' . $name . ']'; // <— quan trọng: đưa vào config[...]

        ob_start(); ?>
        <div class="system-repeater" data-name="<?= e($name) ?>">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm align-middle mb-10">
                    <thead class="bg-light">
                    <tr>
                        <?php foreach ($fields as $key => $def): ?>
                            <th><?= e($columns[$key] ?? ucfirst($key)) ?></th>
                        <?php endforeach; ?>
                        <th class="text-center" style="width:72px">#</th>
                    </tr>
                    </thead>
                    <tbody class="sr-rows">
                    <?php foreach ($rows as $i => $r): ?>
                        <tr>
                            <?php foreach ($fields as $key => $def): ?>
                                <td>
                                    <?php
                                    $fname = $root . '[' . $i . '][' . $key . ']';
                                    $val = $r[$key] ?? '';
                                    $ph = $def['placeholder'] ?? '';
                                    $cls = 'form-control form-control-sm';
                                    switch ($def['type'] ?? 'text') {
                                        case 'textarea':
                                            echo '<textarea class="' . $cls . '" name="' . e($fname) . '" rows="2" placeholder="' . e($ph) . '">' . e($val) . '</textarea>';
                                            break;
                                        case 'select':
                                            echo '<select class="' . $cls . '" name="' . e($fname) . '">';
                                            foreach (($def['option'] ?? []) as $k => $label) {
                                                $sel = (string)$k === (string)$val ? ' selected' : '';
                                                echo '<option value="' . e($k) . '"' . $sel . '>' . e($label) . '</option>';
                                            }
                                            echo '</select>';
                                            break;
                                        default:
                                            echo '<input type="text" class="' . $cls . '" name="' . e($fname) . '" value="' . e($val) . '" placeholder="' . e($ph) . '">';
                                    }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                            <td class="text-center">
                                <button type="button" class="btn btn-xs btn-danger sr-remove">&times;</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-default btn-sm sr-add">
                <i class="icon-plus2"></i> <?= e(__('Add row')) ?>
            </button>

            <template class="sr-template">
                <tr>
                    <?php foreach ($fields as $key => $def): ?>
                        <td>
                            <?php
                            $fname = $root . '[__INDEX__][' . $key . ']';
                            $ph = $def['placeholder'] ?? '';
                            $cls = 'form-control form-control-sm';
                            switch ($def['type'] ?? 'text') {
                                case 'textarea':
                                    echo '<textarea class="' . $cls . '" name="' . e($fname) . '" rows="2" placeholder="' . e($ph) . '"></textarea>';
                                    break;
                                case 'select':
                                    echo '<select class="' . $cls . '" name="' . e($fname) . '">';
                                    foreach (($def['option'] ?? []) as $k => $label) {
                                        echo '<option value="' . e($k) . '">' . e($label) . '</option>';
                                    }
                                    echo '</select>';
                                    break;
                                default:
                                    echo '<input type="text" class="' . $cls . '" name="' . e($fname) . '" value="" placeholder="' . e($ph) . '">';
                            }
                            ?>
                        </td>
                    <?php endforeach; ?>
                    <td class="text-center">
                        <button type="button" class="btn btn-xs btn-danger sr-remove">&times;</button>
                    </td>
                </tr>
            </template>
        </div>
        <?php
        return ob_get_clean();
    }
}
if (!function_exists('convert_array')) {
    function convert_array($system = null, $keyword = '', $value = '')
    {
        $temp = [];
        if (is_array($system)) {
            foreach ($system as $key => $val) {
                $temp[$val[$keyword]] = $val[$value];
            }
        }
        if (is_object($system)) {
            foreach ($system as $key => $val) {
                $temp[$val->{$keyword}] = $val->{$value};
            }
        }

        return $temp;
    }
}

if (!function_exists('build_breadcrumb')) {
    function build_breadcrumb(array $items): array
    {
        array_unshift($items, [
            'title' => 'Trang chủ',
            'url' => url('/'),
        ]);

        return $items;
    }
}
if (!function_exists('category_trail')) {
    function category_trail(Category $category): array
    {
        $items = [];
        $current = $category;
        while ($current) {
            $items[] = [
                'title' => $current->name,
                'url' => router_link('categories', $current->id),
            ];
            $current = $current->parent;
        }

        return array_reverse($items);
    }
}
if (!function_exists('product_breadcrumb')) {
    function product_breadcrumb(Product $product): array
    {
        $items = [];
        if ($product->category) {
            $items = array_merge($items, category_trail($product->category));
        }
        $items[] = [
            'title' => $product->name,
            'url' => null,
        ];
        return build_breadcrumb($items);
    }
}

if (!function_exists('category_breadcrumb')) {
    function category_breadcrumb(Category $category): array
    {
        $items = category_trail($category);
        if (!empty($items)) {
            $lastIndex = count($items) - 1;
            $items[$lastIndex]['url'] = null;
        }

        return build_breadcrumb($items);
    }
}

if (!function_exists('brand_breadcrumb')) {
    function brand_breadcrumb(Brand $brand): array
    {
        $items = [
            [
                'title' => $brand->name,
                'url' => null,
            ],
        ];
        return build_breadcrumb($items);
    }
}
if (!function_exists('post_catalogue_trail')) {
    function post_catalogue_trail(PostCatalogue $catalogue): array
    {
        $ancestors = PostCatalogue::query()->where('lft', '<=', $catalogue->lft)->where('rgt', '>=', $catalogue->rgt)->orderBy('lft')->get();
        $items = [];
        foreach ($ancestors as $row) {
            $items[] = [
                'title' => $row->name,
                'url' => router_link('post_catalogue', $row->id), // ví dụ
            ];
        }
        return $items;
    }
}
if (!function_exists('post_catalogue_breadcrumb')) {
    function post_catalogue_breadcrumb(PostCatalogue $catalogue): array
    {
        $items = post_catalogue_trail($catalogue);
        if (!empty($items)) {
            $lastIndex = count($items) - 1;
            $items[$lastIndex]['url'] = null;
        }
        return build_breadcrumb($items);
    }
}
if (!function_exists('post_breadcrumb')) {
    function post_breadcrumb(Post $post): array
    {
        $items = [];
        if ($post->catalogue) {
            $items = post_catalogue_trail($post->catalogue);
        }
        $items[] = [
            'title' => $post->name ?? $post->title ?? 'Bài viết',
            'url' => null,
        ];
        return build_breadcrumb($items);
    }
}


