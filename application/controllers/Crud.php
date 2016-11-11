controllers/Crud
<?php

/**
 * Description of Crud
 */
class Crud extends Application {
    
    	function __construct() {
		parent::__construct();
                $this->load->helper('formfields');
	}
        
        public function index() {
            $userrole = $this->session->userdata('userrole');
            if ($userrole != 'admin') {
                $message = 'You are not authorized to access this page. Go away';
                $this->data['content'] = $message;
                $this->render();
                return;
            }
            $message = 'Get ready to fix stuff.';
            //$this->data['content'] = $message;
            $this->data['pagebody' ] ='mtce';
            $this->data['items'] = $this->menu->all();
            $this->render();
        }
        
        function edit($id=null) {
            // try the session first
            $key = $this->session->userdata('key');
            $record = $this->session->userdata('record');
            // if not there, get them from the database
            if (empty($key)) {
                $record = $this->menu->get($id);
                $key = $id;
                $this->session->set_userdata('key',$id);
                $this->session->set_userdata('record',$record);
            }
            
            // build the form fields
            $this->data['fid'] = makeTextField('Menu code', 'id', $record->id);
            $this->data['fname'] = makeTextField('Item name', 'name', 
                    $record->name);
            $this->data['fdescription'] = makeTextArea('Description', 
                    'description', $record->description);
            $this->data['fprice'] = makeTextField('Price, each', 'price', 
                    $record->price);
            
            $this->data['fpicture'] = makeTextField('Item image', 'picture', 
                    $record->picture);
            $cats = $this->categories->all(); // get an array of category objects
            foreach($cats as $code => $category) // make it into an associative array
                $codes[$code] = $category->name;
            $this->data['fcategory'] = makeCombobox('Category', 'category', 
                    $record->category,$codes);
            
            $this->data['pagebody'] = "mtce-edit";
            $this->data['zsubmit'] = makeSubmitButton('Save', 'Submit changes');
            $this->render();
        }
        
        function cancel() {
            $this->session->unset_userdata('key');
            $this->session->unset_userdata('record');
            $this->index();
        }
}
