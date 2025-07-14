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
        Schema::table('contacts_and_groups_tables', function (Blueprint $table) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->tinyInteger('status')->default(1)->after('email');
            });

            Schema::table('groups', function (Blueprint $table) {
                $table->tinyInteger('status')->default(1)->after('name');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts_and_groups_tables', function (Blueprint $table) {
            //
        });
    }
};
