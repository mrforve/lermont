<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ConsumerCornerSeeder extends Seeder
{
    public function run(): void
    {
        Page::firstOrCreate(
            ['slug' => 'ugolok-potrebitelya'],
            [
                'title' => 'Уголок потребителя',
                'menu_title' => 'Уголок потребителя',
                'template' => 'default',
                'content' => null,
                'blocks' => [
                    [
                        'type' => 'html',
                        'data' => [
                            'html' => File::get(resource_path('content/consumer-corner.html')),
                        ],
                    ],
                ],
                'is_active' => true,
                'show_in_menu' => false,
                'sort_order' => 10,
                'seo_title' => 'Уголок потребителя — документы отеля «Лермонт»',
                'seo_description' => 'Документы отеля «Лермонт»: правила проживания, политика обработки персональных данных, согласие на обработку, уведомление о cookie, диплом и благодарственные письма.',
            ]
        );
    }
}
