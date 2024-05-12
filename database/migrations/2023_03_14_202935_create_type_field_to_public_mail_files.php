<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeFieldToPublicMailFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('public_mail_files', function (Blueprint $table) {
           $table->tinyInteger('type')->default(0)->comment('0 => saveToPublic, 1 => saveToStorage')->after('file_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('public_mail_files', function (Blueprint $table) {
            //
        });
    }
}
