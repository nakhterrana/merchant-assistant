<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id');
            $table->string('store_hash')->after('password');
            $table->bigInteger('owner_id')->after('store_hash')->nullable();
            $table->string('owner_email')->after('owner_id')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('store_hash');
            $table->dropColumn('owner_id');
            $table->dropColumn('owner_email');
        });
    }
}
