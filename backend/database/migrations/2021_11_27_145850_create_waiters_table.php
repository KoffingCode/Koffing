<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaitersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');;
			$table->string('name');
			$table->string('surname');
			$table->enum('documentType', ['C.C','T.I','C.E'])->default('C.C');
			$table->string('document');
			$table->string('address');
			$table->string('neighbourhood');
			$table->string('city');
			$table->string('phone');
			$table->string('academicLevel');
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
        Schema::dropIfExists('waiters');
    }
}
