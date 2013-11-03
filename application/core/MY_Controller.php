<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller {
	protected $fields;
	
	function __construct() {
		parent::__construct();
	}
	
	function _prepareData(&$data, $from = null) {
		foreach ($this->fields as $field) {
			$data[$field] = $this -> input -> post($field) ? $this -> input -> post($field) : ($from ? $from[$field] : NULL);
		}			
	}
	
}