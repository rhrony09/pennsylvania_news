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
            $table->string('link')->nullable();
            $table->timestamps();
        });

        $social_medias = [
            [
                "name" => "Facebook",
                "icon" => "fa-facebook"
            ],
            [
                "name" => "Twitter",
                "icon" => "fa-x-twitter"
            ],
            [
                "name" => "Instagram",
                "icon" => "fa-instagram"
            ],
            [
                "name" => "LinkedIn",
                "icon" => "fa-linkedin-in"
            ],
            [
                "name" => "WhatsApp",
                "icon" => "fa-whatsapp"
            ],
            [
                "name" => "Pinterest",
                "icon" => "fa-pinterest"
            ],
            [
                "name" => "YouTube",
                "icon" => "fa-youtube"
            ],
            [
                "name" => "Reddit",
                "icon" => "fa-reddit-alien"
            ],
            [
                "name" => "Telegram",
                "icon" => "fa-telegram"
            ],
            [
                "name" => "TikTok",
                "icon" => "fa-tiktok"
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
