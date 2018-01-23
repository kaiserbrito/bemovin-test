<?php
App::uses('AppController', 'Controller');

class EmailsController extends AppController {
	var $uses = array('Email', 'Url');

	public function beforeFilter(){
		header("Access-Control-Allow-Origin: http://localhost:3000");
	}
	
	public function index(){
	}

	public function get_emails(){

		$responser = array(
			'emails'      => $this->Email->find('all', array('limit' => 10)),
			'emailsTotal' => $this->Email->find('count'),
			'urlsTotal'   => $this->Url->find('count'),
			'urlsVisited' => $this->Url->find('count', array(
        'conditions' => array('visited' => 1)
    	))
		); 

		return new CakeResponse(array(
			'statusCode' => 200,
			'type' => 'application/json',
			'body' => json_encode($responser)
		));	
	}
}
