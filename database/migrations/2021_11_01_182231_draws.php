<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Draws extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draws', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('drawing_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('giver_id')->constrained('invitees', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('invitees', 'id')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('draws');
    }
}
