<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('crud_stats', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->string('table_name');
            $table->integer('records_count')->default(0);
            $table->integer('generated_count')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crud_stats');
    }
};
