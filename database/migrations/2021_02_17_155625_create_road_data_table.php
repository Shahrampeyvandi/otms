<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('road_data', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_client')->nullable();
            $table->string('truck')->nullable();
            $table->string('file_no')->nullable();
            $table->string('hbl')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('hs_code')->nullable();
            $table->string('package_type')->nullable();
            $table->string('bl_g_w')->nullable();
            $table->string('package')->nullable();
            $table->string('por_text')->nullable();
            $table->string('pol_text')->nullable();
            $table->string('pod_text')->nullable();
            $table->string('final_dest_text')->nullable();
            $table->string('shipper')->nullable();
            $table->string('consignee')->nullable();
            $table->string('notify')->nullable();
            $table->string('dispatch_date')->nullable();
            $table->string('eta')->nullable();
            $table->string('border_cross_date')->nullable();
            $table->string('discharge_date')->nullable();
            $table->string('goods_description')->nullable();
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
        Schema::dropIfExists('road_data');
    }
}
