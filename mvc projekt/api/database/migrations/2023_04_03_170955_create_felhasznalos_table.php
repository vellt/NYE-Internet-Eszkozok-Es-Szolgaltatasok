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
        Schema::create('felhasznalok', function (Blueprint $t) {
            $t->id();
            $t->string('vezeteknev', 50);
            $t->string('keresztnev', 50);
            $t->date('szuletesi_datum');
            $t->string('email', 62);
            $t->string('jelszo_hash');
            $t->boolean('nem');
            $t->string('profilkep')->nullable();
            $t->boolean('hirelevelezes');
            $t->timestamp('gdpr_elfogadva')->useCurrent();
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
        Schema::dropIfExists('felhasznalok');
    }
};
