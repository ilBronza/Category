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
        Schema::create(config('category.models.category.table'), function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('slug');
            $table->string('name');

            $table->string('collection')->nullable();

            $table->uuid('parent_id')->nullable();

            $table->json('cached_children')->nullable();
            $table->timestamp('children_parsed_at')->nullable();
            $table->string('sorting_index')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table(config('category.models.category.table'), function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on(config('category.models.category.table'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('category.models.category.table'));
    }
}
