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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('first_name',100);
            $table->string('last_name',100)->after('first_name');
            $table->double('longitude', 10, 6)->nullable()->after('last_name');
            $table->double('latitude', 10, 6)->nullable()->after('longitude');
            $table->integer('balance')->default(0);
            $table->tinyInteger('rating')->default(0);
            $table->enum('status',['active','inactive']);
            $table->softDeletes();
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
        Schema::dropIfExists('drivers');
    }
};
