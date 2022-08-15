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
            $table->id('detail_id');
            $table->double('health_beauty')->default(0);
            $table->double('flower_decor')->default(0);
            $table->double('invitation')->default(0);
            $table->double('attire')->default(0);
            $table->double('music')->default(0);
            $table->double('ceremony')->default(0);
            $table->double('jewelry')->default(0);
            $table->double('photo_video')->default(0);
            $table->double('catering')->default(0);
            $table->double('transportation')->default(0);
            $table->double('venue')->default(0);
            $table->double('souvenir')->default(0);
            $table->unsignedBigInteger('wedding_id');
            $table->foreign('wedding_id')->references('id')->on('weddings')->onDelete('cascade');
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
