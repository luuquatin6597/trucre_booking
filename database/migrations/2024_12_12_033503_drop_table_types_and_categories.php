<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Xóa các khóa ngoại
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropForeign('rooms_category_id_foreign');
            $table->dropForeign('rooms_type_id_foreign');
        });

        // Xóa các cột
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['type_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
