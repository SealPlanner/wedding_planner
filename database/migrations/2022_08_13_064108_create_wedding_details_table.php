<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wedding_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')->constrained('weddings');
            $table->string('health_beauty');
            $table->string('flower_decor');
            $table->string('invitation');
            $table->string('attire');
            $table->string('music');
            $table->string('ceremony');
            $table->string('jewelry');
            $table->string('photo_video');
            $table->string('catering');
            $table->string('transportation');
            $table->string('venue');
            $table->string('souvenir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wedding_details');
    }
}
