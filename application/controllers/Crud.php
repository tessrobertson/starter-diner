controllers/Crud
<?php

/**
 * Description of Crud
 */
class Crud extends Application {
    
    	function __construct() {
		parent::__construct();
	}
        
	public function index()	{
                $role = $this->session->userdata('userrole');
            	if ($role == 'user')
                    $stuff = file_get_contents('../data/menuUser.md');
		else if ($role == 'admin')
                    $stuff = file_get_contents('../data/menuAdmin.md');
            
                $this->data['content'] = $this->parsedown->parse($stuff);
                $this->render('template');
	}
}
