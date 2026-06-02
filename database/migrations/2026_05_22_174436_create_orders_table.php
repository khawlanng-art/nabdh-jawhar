<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id(); // Primary Key للطلب

        // ربط المستخدم (العمود الذي أنشأناه يدوياً ليتطابق مع UserID في جدول المستخدمين)
        $table->unsignedBigInteger('UserID');
        $table->foreign('UserID')->references('UserID')->on('users')->onDelete('cascade');

        // ربط الممرضة (nurse_id يشير إلى UserID في جدول users)
        $table->unsignedBigInteger('nurse_id')->nullable();
        $table->foreign('nurse_id')->references('UserID')->on('users')->onDelete('set null');

        // ربط الخدمة (بافتراض أن الجدول اسمه services والـ Primary Key هو ServiceID)
        $table->unsignedBigInteger('service_id');
        $table->foreign('service_id')->references('ServiceID')->on('services')->onDelete('cascade');

        // البيانات الأخرى
        $table->integer('patients_count')->default(1);
        $table->decimal('service_duration', 4, 2)->default(1.00);
        $table->decimal('total_price', 10, 2);
        $table->string('status')->default('pending');

        $table->tinyInteger('rating')->nullable();
        $table->text('review')->nullable();

        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
