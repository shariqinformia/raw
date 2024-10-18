<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('venue_name');
            $table->string('address');
            $table->string('post_code');
            $table->string('region');
            $table->string('city');
            $table->string('primary_contact_number');
            $table->string('telephone_number');
            $table->string('email')->unique();
            $table->string('parking');
            $table->text('access_instructions', 255)->nullable();
            $table->tinyInteger('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venues');
    }
}
