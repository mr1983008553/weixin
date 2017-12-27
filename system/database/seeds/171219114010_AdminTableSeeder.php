<?php namespace system\database\seeds;
use houdunwang\database\build\Seeder;
use houdunwang\db\Db;
class AdminTableSeeder extends Seeder {
    //执行
	public function up() {
		//Db::table('news')->insert(['title'=>'后盾人']);
		$data = [
			'username'=>'admin',
			'password'=>password_hash ('admin888',PASSWORD_DEFAULT),
		];
		Db::table('admin')->insert($data);
    }
    //回滚
    public function down() {

    }
}