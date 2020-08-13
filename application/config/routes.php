<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$route['dashboard']                    = 'DashboardController/dashboard';

//$route['hasil']                        = 'LaporanController/hasil_rekap_warga';


$route['lokasi']                        = 'HomeController/index';
$route['tambah-lokasi']                 = 'HomeController/tambah_data';
$route['employee']               	    = 'EmployeeController/index';

$route['default_controller']           = 'HomeController';
//$route['404_override'] = 'HomeController/error';
$route['translate_uri_dashes']         = FALSE;
?>