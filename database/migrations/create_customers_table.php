<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('customer_name');
            $table->integer('gender')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('phonenum')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('type')->nullable();
            
            // Set up foreign keys
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
            Schema::dropIfExists('customers');
        } catch (QueryException $e) {
            echo "Không thể xoá phần tử trong bảng 'customers' vì có sự liên kết khoá ngoại!";
        }
    }
};
