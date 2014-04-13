<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['mtp_crypto'] = 'tls';
//$config['smtp_crypto'] = 'ssl';
$config['protocol'] = 'smtp';
//$config['smtp_host'] = 'mail.smartgamers.com.pe';
//$config['smtp_port'] = 25;
$config['smtp_host'] = 'ssl://mail.smartgamers.com.pe';
//$config['smtp_host'] = 'gator2019.hostgator.com';
$config['smtp_port'] = 465;
//$config['smtp_user'] = 'soporte@smartgamers.com.pe';
$config['smtp_user'] = 'servicios@smartgamers.com.pe';
$config['smtp_pass'] = 'wzaumahp';
$config['mailtype'] = 'html';

    
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE; 

//$this->email->initialize($config);