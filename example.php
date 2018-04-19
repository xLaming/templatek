<?php
require_once('src/class.TemplateK.php');

/**
 * General settings (used to start the class)
 */
$path = 'templates';
$page = 'welcome';

/**
 * Initializate the class
 */
$tpl = new TemplateK($path, $page);

/**
 * Set variables that will be loaded in the HTML file (template)
 */
$tpl->setVar('PAGETITLE', 'Hello World');
$tpl->setVar('H2_MESSAGE', 'Welcome to my world!');
$tpl->setVar('MY_TEXT', 'This is my place used for tests, feel in home!');

/**
 * Used in IF for testing only
 */
$tpl->setVar('VALUE', 2);
$tpl->setVar('VALUE_2', 1);
$tpl->setVar('VALUE_3', true);

/**
 * Turn on/off minify system (optional)
 */
$tpl->setMinify(true);

/**
 * Set custom headers (optional)
 */
$tpl->addHeader('Template-Engine', 'TemplateK');

/**
 * Display the page
 */
$tpl->show();
?>
