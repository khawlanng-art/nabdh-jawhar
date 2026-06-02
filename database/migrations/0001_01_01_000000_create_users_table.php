<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    // 1. جدول المستخدمين الأساسي
    Schema::create('users', function (Blueprint $table) {
        $table->id('UserID');
        $table->string('Username')->unique();
        $table->string('email')->unique();
        $table->string('password');
        $table->enum('Role', ['Admin', 'Nurse', 'Patient','Guest'])->default('Patient');
         $table->string('Status')->default('Pending');
        $table->rememberToken(); // مهم لبقاء تسجيل الدخول يعمل في المتصفح
        $table->timestamps();
    });


    Schema::create('profile_users', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('UserID');
    $table->string('PhoneNumber');
    $table->string('Gender')->nullable();
    $table->date('DateOfBirth')->nullable();
    $table->string('Address')->nullable();
      $table->string('City')->nullable();
    $table->string('HospitalOrCenter')->nullable();
    $table->string('Specialization')->nullable();
    $table->string('ProfilePicture')->nullable();

    $table->string('HealthCertificate')->nullable();


    $table->timestamps();


    $table->foreign('UserID')->references('UserID')->on('users')->onDelete('cascade');
});}

public function down(): void
{
    Schema::dropIfExists('profile_users');
    Schema::dropIfExists('users');

}
};
