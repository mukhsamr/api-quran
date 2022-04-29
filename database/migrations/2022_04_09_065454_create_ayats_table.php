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
        Schema::create('ayats', function (Blueprint $table) {
            $table->integer('ayat');
            $table->foreignId('surat_id')->constrained('surat')->onDelete('restrict')->onUpdate('cascade');
            $table->string('text');
            $table->string('trans');
            $table->string('latin');
            $table->integer('hizb');
            $table->integer('juz');
            $table->integer('sajdah');
            $table->integer('page');
            $table->integer('startjuz');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayats');
    }
};
