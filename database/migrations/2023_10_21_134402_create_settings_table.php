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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value')->nullable();
            $table->timestamps();
        });

        $data = [
            'site_name' => 'পেনসিলভানিয়া নিউজ',
            'site_tagline' => 'পেনসিলভানিয়া নিউজ',
            'email' => 'example@email.com',
            'phone' => '+8801XXXXXXXXX',
            'fax' => '+8801XXXXXXXXX',
            'address' => 'House: 21, Road: 3, Banani DOHS, Dhaka-1206, Bangladesh',
            'chief_editor' => 'রওশন হাবিব রনি',
            'editor_publisher' => 'নুসরাত জাহান রিচি',
            'site_primary_color' => '#186F65',
            'site_accent_color' => '#069181',
            'site_secondary_color' => '#B2533E',
            'site_secondary_accent_color' => '#FCE09B',
            'logo_dark' => 'logo-dark.png',
            'logo_light' => 'logo-light.png',
            'favicon' => 'favicon.png',
            'version' => '1.0.1',
        ];

        foreach ($data as $key => $value) {
            DB::table('settings')->insert([
                'key' => $key,
                'value' => $value
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('settings');
    }
};
