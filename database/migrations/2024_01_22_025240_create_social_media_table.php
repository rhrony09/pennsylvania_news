<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->timestamps();
        });

        $social_medias = [
            [
                "name" => "Facebook",
                "icon" => "fa-brands fa-facebook"
            ],
            [
                "name" => "Twitter",
                "icon" => "fa-brands fa-twitter"
            ],
            [
                "name" => "Instagram",
                "icon" => "fa-brands fa-instagram"
            ],
            [
                "name" => "LinkedIn",
                "icon" => "fa-brands fa-linkedin-in"
            ],
            [
                "name" => "Pinterest",
                "icon" => "fa-brands fa-pinterest"
            ],
            [
                "name" => "Snapchat",
                "icon" => "fa-brands fa-snapchat"
            ],
            [
                "name" => "YouTube",
                "icon" => "fa-brands fa-youtube"
            ],
            [
                "name" => "Reddit",
                "icon" => "fa-brands fa-reddit-alien"
            ],
            [
                "name" => "Tumblr",
                "icon" => "fa-brands fa-tumblr"
            ],
            [
                "name" => "WhatsApp",
                "icon" => "fa-brands fa-whatsapp"
            ],
            [
                "name" => "Telegram",
                "icon" => "fa-brands fa-telegram"
            ],
            [
                "name" => "Flickr",
                "icon" => "fa-brands fa-flickr"
            ],
            [
                "name" => "Vimeo",
                "icon" => "fa-brands fa-vimeo-v"
            ],
            [
                "name" => "TikTok",
                "icon" => "fa-brands fa-tiktok"
            ],
            [
                "name" => "WeChat",
                "icon" => "fa-brands fa-weixin"
            ]
        ];

        foreach ($social_medias as $social_media) {
            DB::table('social_media')->insert([
                'name' => $social_media['name'],
                'icon' => $social_media['icon']
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('social_media');
    }
};
