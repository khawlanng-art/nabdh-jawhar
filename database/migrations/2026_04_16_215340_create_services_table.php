<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * تشغيل التهجير (Migration)
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('ServiceID');
            $table->string('ServiceName');
            $table->text('Description')->nullable();
            $table->decimal('BasePrice', 8, 2);

            // تعديل حقل التصنيف ليكون قائمة اختيارية محددة
            $table->enum('CategoryName', ['تمريض', 'رعاية'])->default('تمريض');

            $table->string('IconURL')->nullable();
            $table->boolean('IsActive')->default(true);
            $table->timestamps();
                   });
    }

    /**
     * التراجع عن التهجير
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
