<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    OrgTree
 * @version    1.0.0
 * @author     Coy Clayton <coyclayton@gmail.com>
 * @license    MIT License
 * @copyright  2010 - 2013 Coy Clayton
 */


Autoloader::add_core_namespace('UUID');

Autoloader::add_classes(array(
	'UUID\\UUID'					 => __DIR__.'/classes/uuid.php',
	'UUID\\UUIDException'			 => __DIR__.'/classes/uuid.php'
));