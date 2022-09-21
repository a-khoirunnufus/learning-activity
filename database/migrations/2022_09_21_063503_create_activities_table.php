<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->integer('session_id');
            $table->integer('method_id');
            $table->string('title');
            $table->date('start');
            $table->date('finish');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->foreign('session_id')
                ->references('id')
                ->on('sessions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('method_id')
                ->references('id')
                ->on('ref_methods')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign('activities_session_id_foreign');
            $table->dropForeign('activities_method_id_foreign');
        });
        Schema::dropIfExists('activities');
    }
}
