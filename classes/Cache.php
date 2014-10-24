<?php

class Cache{
	
	private $cachetime;
	private $url;
	private $cachefile;
	
	public function __construct(){
		
		$this->cachetime = 60*60*48;
		// $this->url = basename($_SERVER['REQUEST_URI']);
		$this->url = $_SERVER['REQUEST_URI'];
		$this->cachefile = getcwd().'/cache/' . preg_replace("([^a-zA-Z0-9_.-])", "", str_replace('/', '-', substr($this->url, 1) ) ) . '.html';
	}
	
	public function inicio(){
		
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ){
						
			if (file_exists($this->cachefile) && time() - $this->cachetime < filemtime($this->cachefile)) {
				
				include($this->cachefile);
				echo "<!-- Cached copy, generated ".date('d-m-Y H:i', filemtime($this->cachefile))." -->\n";
				exit;
			}
			
			ob_start();
			
		}
	}
	
	
	public function fim(){
		
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ){
			$cached = fopen($this->cachefile, 'w');
			fwrite($cached, ob_get_contents());
			fclose($cached);
			ob_end_flush();
		}
	}
	
}

?>