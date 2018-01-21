<?php
App::uses('AppModel', 'Model');
/**
 * Url Model
 */
class Url extends AppModel {

	/**
	 * Get all email from urls group and saves the adjacent urls
	 * @param Array $urls URLs returned by database
	 * @return Array emails contained in the pages of urls passed by $urls
	 */
	public function getEmails($urls){
		$emails = array();
		foreach ($urls as $url){
			$url =  $url['Url']['url'];

			$data = $this->getLinksAndEmails($url);

			$emails = $emails + $data['emails'];

			$results = array(
				'base'      => $url,
				'resulting' => $data['urls']
			);
			
			foreach ($this->rectifier($results) as $newUrl) {
	    		$this->create();
	    		$this->save($newUrl);
			}
		};

		return $emails;
	}

	/**
	 * Translates urls adjacent to the system default (if necessary)
	 * @param Array $info Array containing $info['base'] = "base URL" and $info['resulting'] = 'array of urls adjacent'
	 * @return Array
	 */
	public function rectifier($info){
	 	$newUrls = array();
	 	foreach ($info['resulting'] as $badUrl) {
	 		$badUrl = $badUrl[1];

	 		if(strpos($badUrl, '"') !== false)
	 			continue;

		 	if(preg_match("#^https?://.+#", $badUrl))
		 		$newUrls[]['url'] = $badUrl;
		 	
		 	elseif($badUrl[0] == '/'){
		 		if($badUrl[1] == '/')
		 			$newUrls[]['url'] = "https:$badUrl";
		 		else{
			 		$baseEx     = explode('://', $info['base']);
		 			$paths      = explode('/', $baseEx[1]);

			 		$newUrls[]['url'] = "{$baseEx[0]}://{$paths[0]}$badUrl";
		 		}
		 	}
		 	else{
		 		if(substr($info['base'], -1)  == '/')
		 			$info['base']  = substr($info['base'], 0, -1);

		 		$newUrls[]['url'] = "{$info['base']}/$badUrl";
		 	}
	 	}

	 	return array_unique($newUrls, SORT_REGULAR);
	}

	/**
	 * Get urls and emails on web pages
	 * @param String With the url of the page that contains links and emails
	 * @return Array
	 */
	public function getLinksAndEmails($url){
		$url = html_entity_decode($url);

		pr("Acessando: $url");
		$content = @file_get_contents($url);

    	$this->updateAll(
		    array('Url.visited' => "'yes'"),
		    array('Url.url'     => $url)
		);
		
		if($content === false){
			pr("Status: Erro (URL quebrada)");
			return array(
	    		'emails' => array(),
	    		'urls'   => array()
	    	);;
		}
		
		pr("Status: OK");

		$linkExp = '/<a href=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?>/i';
    	preg_match_all($linkExp, $content, $urls, PREG_SET_ORDER);

    	$emailExp = '/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i';
    	preg_match_all($emailExp, $content, $emails, PREG_SET_ORDER);

    	return array(
    		'emails' => $emails,
    		'urls'   => $urls
    	);
	}

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'url';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'url' => array(
			'unique' => array('rule' => 'isUnique')
		)
	);
}
