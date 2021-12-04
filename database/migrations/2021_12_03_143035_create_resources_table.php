<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->string('resource_id', 64)->unique();
            $table->string('resource_source_id', 64)->nullable();
            $table->string('resource_category_id', 64)->nullable();
            $table->string('resource_label');
            $table->string('resource_slug');
            $table->text('resource_desc')->nullable();
            $table->text('resource_link');
            $table->text('resource_preview');
            $table->boolean('resource_active')->default(true);
            $table->timestamps();

            $table->foreign('resource_category_id')->references('category_id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('resource_source_id')->references('source_id')->on('sources')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropForeign('resources_resource_category_id_foreign');
            $table->dropForeign('resources_resource_source_id_foreign');
        });
        Schema::dropIfExists('resources');
    }
}
