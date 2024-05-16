<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorizablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('category.models.categorizable.table'), function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('category_id')->index();
            $table->foreign('category_id')->references('id')->on(config('category.models.category.table'));

            $table->nullableUlidMorphs('categorizable', 'categorizable_index');

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
        Schema::dropIfExists(config('category.models.categorizable.table'));
    }
}
