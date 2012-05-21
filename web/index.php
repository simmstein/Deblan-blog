<?php

if(!preg_match('`www`', $_SERVER['SERVER_NAME'])) {
	header('Location: http://'.str_replace('deblan', 'www.deblan', $_SERVER['SERVER_NAME']).$_SERVER['REQUEST_URI']);
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

if(isset($_GET['_escaped_fragment_'])) {
	die(header('location: '.$_GET['_escaped_fragment_']));
}

$configuration = ProjectConfiguration::getApplicationConfiguration('www', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
