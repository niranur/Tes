<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
//sisipkan file tcpdf dsni

require_once dirname(__file__).'/tcpdf/tcpdf.php';

class pdf_report extends TCPDF
{
	protected $ci;
	function __construct()
	{
		$this->ci =& get_instance();
	}
}
