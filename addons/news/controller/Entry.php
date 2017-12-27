<?php

namespace addons\news\controller;

class Entry
{
	public function index(){
		//echo 'addons news index';
		return view ('addons/news/template/entry/index.php');

	}
}