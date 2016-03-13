<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

$config['protocol']     = 'smtp';
$config['smtp_host']    = '';
$config['smtp_port']    = 587;
$config['smtp_user']    = '';
$config['smtp_pass']    = '';
$config['smtp_timeout'] = '7';
$config['charset']      = 'utf-8';
$config['newline']      = "\r\n";
$config['mailtype']     = 'text';// or html
$config['validation']   = TRUE;// bool whether to validate email or not

// $config['protocol'] = 'smtp';
// $config['smtp_host'] = 'ssl://smtp.gmail.com';
// $config['smtp_port'] = 465;
// $config['smtp_user'] = '@gmail.com';
// $config['smtp_pass'] = '';
// $config['smtp_timeout'] = '7';
// $config['charset']    = 'utf-8';
// $config['newline']    = "\r\n";
// $config['mailtype'] = 'text'; // or html
// $config['validation'] = TRUE; // bool whether to validate email or not
