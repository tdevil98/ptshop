<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdColumnCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('categories', 'user_id')){
            Schema::table('categories', function (Blueprint $table) {
                $table->integer('user_id')->after('parent_id')->comment('Id nguòi tạo');
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
        if(Schema::hasColumn('categories', 'user_id'))
        {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }

    }
}
