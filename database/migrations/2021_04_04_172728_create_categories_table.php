<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->string('slug')->primary();
            $table->string('name');

            $table->string('collection')->nullable();

            // $table->string('parent_slug')->nullable();
            // $table->foreign('parent_slug')->references('slug')->on('categories');

            $table->json('cached_children')->nullable();
            $table->timestamp('children_parsed_at')->nullable();
            $table->string('sorting_index')->nullable();

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
        Schema::dropIfExists('categories');
    }
}
