<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
		$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
		$this->template->title = "Home of ".APP_NAME;
        # add Menu if user already logged in (taking advantage of the global $this->user)
        $this->template->hide_menu = FALSE;
        $this->template->menu = View::instance('v_menu');
       # if ($this->user) {       	
       # 	$this->template->menu = View::instance('v_menu1');
		#}
		#else {
			# For new users present a friendlier signup (some incentive) or login option
		#	$this->template->menu = View::instance('v_menu');
		#}
		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/
		# Render the view
		echo $this->template;
	 
	} # End of method
	
	
} # End of class
