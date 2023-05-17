<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('cnpj')->unique();
            $table->string('company')->unique();
            $table->string('url')->unique();
            $table->string('email')->unique();
            $table->string('logo')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('manager')->default(false);
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
        Schema::dropIfExists('tenants');
    }
}
