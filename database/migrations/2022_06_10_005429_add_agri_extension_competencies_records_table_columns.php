<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgriExtensionCompetenciesRecordsTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agri_extension_competencies_records', function (Blueprint $table) {
            $table->string('created_by')->after('k_additional_information')->nullable();
            $table->string('cookie_id')->after('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agri_extension_competencies_records', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'cookie_id']);
        });
    }
}
