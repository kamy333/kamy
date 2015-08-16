<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
 //defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'home' . DS . 'www' . DS . '1fe720ae68582bc8524d72e4d0afafcb' . DS . 'web');
 




echo __FILE__ ."<br />";
echo __LINE__ ."<br />"; // be careful once you include files
echo dirname(__FILE__) ."<br >";
echo __DIR__ ."<br />"; // only PHP 5.3

echo file_exists(__FILE__) ? 'yes' : 'no';
echo "<br />";
echo file_exists(dirname(__FILE__)."/basic.html") ? 'yes' : 'no';
echo "<br />";
echo file_exists(dirname(__FILE__)) ? 'yes' : 'no';
echo "<br />";

echo is_file(dirname(__FILE__)."/basic.html") ? 'yes' : 'no';
echo "<br />";
echo is_file(dirname(__FILE__)) ? 'yes' : 'no';
echo "<br />";

echo is_dir(dirname(__FILE__)."/basic.html") ? 'yes' : 'no';
echo "<br />";
echo is_dir(dirname(__FILE__)) ? 'yes' : 'no';
echo "<br />";
echo is_dir('..') ? 'yes' : 'no';
echo "<br />";

?>