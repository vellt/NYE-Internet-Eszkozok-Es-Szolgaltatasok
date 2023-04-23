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
        Schema::create('jogi_dokumentumok', function (Blueprint $t) {
            $t->id();
            $t->string('utvonal',40)->unique();
            $t->string('nev',40);
            $t->text('leiras');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jogi_dokumentumok');
    }
};
