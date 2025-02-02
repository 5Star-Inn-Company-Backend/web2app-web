<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToConverts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->after('role_id', function (Blueprint $table) {
            $table->text("description")->nullable();
            $table->string("plan");
            $table->json("branding")->nullable();
            $table->json("link_handling")->nullable();
            $table->json("interface")->nullable();
            $table->json("website_overide")->nullable();
            $table->json("permission")->nullable();
            $table->json("navigation")->nullable();
            $table->json("notification")->nullable();
            $table->json("plugin")->nullable();
            $table->json("build_setting")->nullable();
            $table->string("private_link")->nullable();
            $table->string("public_link")->nullable();
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
        Schema::table('apps', function (Blueprint $table) {
            $table->dropColumn("description");
            $table->dropColumn("plan");
            $table->dropColumn("branding");
            $table->dropColumn("link_handling");
            $table->dropColumn("interface");
            $table->dropColumn("website_overide");
            $table->dropColumn("permission");
            $table->dropColumn("navigation");
            $table->dropColumn("notification");
            $table->dropColumn("plugin");
            $table->dropColumn("build_setting");
            $table->dropColumn("private_link");
            $table->dropColumn("public_link");
        });
    }
}
