<?php

class Menu extends MY_Model {

	// constructor
	function __construct()
	{
		parent::__construct();
	}

	function rules() {
            $config = [
                ['field'=>'id', 'label'=>'Menu code', 'rules'=> 'required|integer'],
                ['field'=>'name', 'label'=>'Item name', 'rules'=> 'required'],
                ['field'=>'description', 'label'=>'Item description', 'rules'=> 'required|max_length[256]'],
                ['field'=>'price', 'label'=>'Item price', 'rules'=> 'required|decimal'],
                ['field'=>'picture', 'label'=>'Item picture', 'rules'=> 'required'],
                ['field'=>'category', 'label'=>'Menu category', 'rules'=> 'required']
            ];
            return $config;
        }
}
