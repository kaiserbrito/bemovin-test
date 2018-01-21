<?php
// Somente em php -v >= 5.2.9
class CrawlerShell extends Shell {
    var $uses = array('Email', 'Url');

    public function main(){
    	$this->clear();
    	$this->out('Bem-vindo!');
    	$this->out('Para para o Crawler precione: control + c');
    	
    	while ($urls = $this->Url->find('all', array('conditions' => array('visited' => 'no'), 'order' => 'id ASC'))) {
    		$emails = $this->Url->getEmails($urls);

    		foreach ($emails as $email) {
	    		$this->Email->create();
	    		$this->Email->save(array('email' => $email[0]));
    		}
    	}
    }
}