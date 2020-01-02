<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaleCountColumnToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('products', 'sale_count')){
            Schema::table('products', function (Blueprint $table) {
                $table->integer('sale_count')->after('category_id')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('products', 'sale_count')){
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('sale_count');
            });
        }
    }
}
