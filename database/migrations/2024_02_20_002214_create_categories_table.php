<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        $categories = [
            'জাতীয়',
            'পেনসিলভানিয়া',
            'রাজনীতি',
            'আমেরিকা',
            'অর্থনীতি',
            'খেলার মাঠ',
            'বহি:বিশ্ব',
            'বিনোদন'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'slug' => make_slug($category),
            ]);
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('categories');
    }
};
