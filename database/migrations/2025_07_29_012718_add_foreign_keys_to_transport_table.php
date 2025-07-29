<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transport', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign(['destination_id'], 'transport_ibfk_1')->references(['id'])->on('destination');
            $table->foreign(['client_id'], 'transport_ibfk_2')->references(['id'])->on('client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transport', function (Blueprint $table) {
            $table->dropForeign('transport_ibfk_1');
            $table->dropForeign('transport_ibfk_2');
        });
    }
};
