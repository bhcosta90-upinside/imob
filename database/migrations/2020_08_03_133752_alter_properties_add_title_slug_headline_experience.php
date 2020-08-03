<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPropertiesAddTitleSlugHeadlineExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->string('slug')->nullable()->after('title');
            $table->string('headline')->nullable()->after('slug');
            $table->string('experience')->nullable()->after('headline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('slug');
            $table->dropColumn('headline');
            $table->dropColumn('experience');
        });
    }
}
