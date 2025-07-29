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
        Schema::create('transport', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id', true);
            $table->date('date');
            $table->string('designation');
            $table->string('immatriculation_vehicule');
            $table->integer('destination_id')->index('destination_id');
            $table->string('numero_declaration');
            $table->integer('client_id')->index('client_id');
            $table->float('poids', 10, 0);
            $table->integer('droit_douane')->nullable();
            $table->integer('frais_kati')->nullable();
            $table->integer('frais_frontiere')->nullable();
            $table->integer('frais_circuit')->nullable();
            $table->integer('frais_rapport')->nullable();
            $table->integer('frais_ts')->nullable();
            $table->integer('total_frais')->nullable();
            $table->integer('prix');
            $table->integer('benefice_esperer')->nullable();
            $table->integer('paiement')->nullable();
            $table->integer('benefice_reel')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transport');
    }
};
