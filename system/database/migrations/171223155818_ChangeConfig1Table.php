<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class ChangeConfig1Table extends Migration {
    //执行
	public function up() {
		Schema::table( 'config', function ( Blueprint $table ) {
			//$table->string('name', 50)->add();
            $table->text('wechat_config')->add();
        });
    }

    //回滚
    public function down() {
            //Schema::dropField('config', 'name');
        Schema::dropField('config', 'wechat_config');
    }
}