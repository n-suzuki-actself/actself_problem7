<?php

namespace App\Controller;

class TestController extends AppController{

	public $name = 'Test';
	public $autoRender = true;

	public function kato(){

		$books[] = [
			'title' => "タイトル１",
			'author' => "作者１"
		];

		$books[] = [
			'title' => "タイトル2",
			'author' => "作者2"
		];

		//var_dump($books);exit;



		$this->set('books', $books);

		$this->viewBuilder()->autoLayout(false);

	}


}
