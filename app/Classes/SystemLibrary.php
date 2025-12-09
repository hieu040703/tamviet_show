<?php

namespace App\Classes;

class SystemLibrary
{

    public function config()
    {
        $data['homepage'] = [
            'label' => 'Thông Tin Chung',
            'description' => 'Cài đặt đầy đủ thông tin chung của website. Tên thương hiệu website, Logo, Favicon, vv...',
            'value' => [
                'company' => ['type' => 'text', 'label' => 'Tên công ty'],
                'brand' => ['type' => 'text', 'label' => 'Tên thương hiệu'],
                'slogan' => ['type' => 'text', 'label' => 'Slogan'],
                'logo' => ['type' => 'images', 'label' => 'Logo Website', 'title' => 'Click vào ô phía dưới để tải logo'],
                'favicon' => ['type' => 'images', 'label' => 'Favicon', 'title' => 'Click vào ô phía dưới để tải logo'],
                'copyright' => ['type' => 'text', 'label' => 'Copyright'],
                'website' => [
                    'type' => 'select',
                    'label' => 'Tình trạng website',
                    'option' => [
                        'open' => 'Mở của website',
                        'close' => 'Website đang bảo trì',
                    ]
                ],
                'short_intro' => ['type' => 'editor', 'label' => 'Giới thiệu ngắn'],
            ]
        ];

        $data['contact'] = [
            'label' => 'Thông tin liên hệ',
            'description' => 'Cài đặt thông tin liên hệ của website ví dụ: Địa chỉ công ty, Văn phòng giao dịch, Hotline, Bản đồ, vv...',
            'value' => [
                'office' => ['type' => 'text', 'label' => 'Địa chỉ công ty'],
                'address' => ['type' => 'text', 'label' => 'Văn phòng giao dịch'],
                'hotline' => ['type' => 'text', 'label' => __('hotline')],
                'technical_phone' => ['type' => 'text', 'label' => 'Hotline kỹ thuật'],
                'sell_phone' => ['type' => 'text', 'label' => 'Hotline kinh doanh'],
                'phone' => ['type' => 'text', 'label' => 'Số cố định'],
                'zalo' => ['type' => 'text', 'label' => __('zalo')],
                'fax' => ['type' => 'text', 'label' => __('fax')],
                'email' => ['type' => 'text', 'label' => __('email')],
                'website' => ['type' => 'text', 'label' => __('website')],
                'map' => [
                    'type' => 'textarea',
                    'label' => __('map'),
                    'link' => [
                        'text' => __('map_guide'),
                        'href' => 'https://manhan.vn/hoc-website-nang-cao/huong-dan-nhung-ban-do-vao-website/',
                        'target' => '_blank'
                    ]
                ],
            ]
        ];
        $data['seo'] = [
            'label' => 'Cấu hình SEO dành cho trang chủ',
            'description' => 'Cài đặt đầy đủ thông tin về SEO của trang chủ website. Bao gồm tiêu đề SEO, Từ Khóa SEO, Mô Tả SEO, Meta images',
            'value' => [
                'meta_title' => ['type' => 'text', 'label' => 'Tiêu đề SEO'],
                'meta_keyword' => ['type' => 'text', 'label' => 'Từ khóa SEO'],
                'meta_description' => ['type' => 'textarea', 'label' => 'Mô tả SEO'],
                'meta_images' => ['type' => 'images', 'label' => 'ảnh SEO'],
            ]
        ];
        $data['social'] = [
            'label' => 'Cấu hình mạng xã hội',
            'description' => 'Cài đặt đầy đủ thông tin về Mạng xã hội của trang chủ website. Bao gồm tiêu đề Mạng xã hội, Từ Khóa SEO, Mô Tả SEO, Meta images',
            'value' => [
                'facebook' => ['type' => 'text', 'label' => __('facebook')],
                'youtube' => ['type' => 'text', 'label' => __('youtube')],
                'twitter' => ['type' => 'text', 'label' => __('twitter')],
                'tiktok' => ['type' => 'text', 'label' => __('tiktok')],
                'instagram' => ['type' => 'text', 'label' => __('instagram')],
                'zalo_qr' => ['type' => 'images', 'label' => __('Zalo Code')],
            ]
        ];
        return $data;
    }
}
