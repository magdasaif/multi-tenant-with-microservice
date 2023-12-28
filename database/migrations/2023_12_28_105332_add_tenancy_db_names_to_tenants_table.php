<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTenancyDbNamesToTenantsTable extends Migration
{
    public function up()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->json('tenancy_db_names')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('tenancy_db_names');
        });
    }
}
