<?php

use Illuminate\Database\Seeder;
use App\Models\Widget;
use App\Models\WidgetItem;
use App\Models\Router;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $widget = Widget::updateOrCreate(
            ['code' => 'home_featured_brands'],
            [
                'name'   => 'Thương hiệu nổi bật',
                'type'   => 'brands',
                'limit'  => 8,
                'status' => 1,
            ]
        );
        $canonicals = [
            'thuong-hieu-1',
            'thuong-hieu-2',
            'thuong-hieu-3',
        ];

        $sort = 0;

        foreach ($canonicals as $slug) {
            $router = Router::where('canonical', $slug)->first();

            if (!$router) {
                continue;
            }

            WidgetItem::updateOrCreate(
                [
                    'widget_id' => $widget->id,
                    'router_id' => $router->id,
                ],
                [
                    'title'      => null,
                    'subtitle'   => null,
                    'image'      => null,
                    'sort_order' => $sort++,
                ]
            );
        }
    }
}
