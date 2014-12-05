<?php

/**
 * Demo Plugin
 *
 * This plugin show how to make a plugin for roundcube by showing the basics (and some advanced stuff).
 *
 * @version 1.0.0
 * @author Chris Simon <info@decomputeur.nl> from version 2.1.3
 *   
 */

/**
 * First we define our class that extends the rcube_plugin class
 */
class filters extends rcube_plugin{

	/**
	 * Here we define in what parts of the roundcube app we are going to hook our plugin into
	 * Valid choices are: login logout mail addressbook settings
	 * To use multiple tasks for a single plugin, seperate them with a pipe symbol
	 *
	 *For demo purposes, we use only settings in our demo
	 */
  public $task = 'settings';
	/**
	 * Now you can define your own needed class wide variables like the following sample
	 * private $myvar;
	 *
	 * Just make sure to define all variables as private
	 */
  private $rc;    

	/**
	 * This is the main function of the plugin that gets called when the plugin is initialized.
	 */
  function init(){
	/** First we need to get a instance to the current working roundcube in which out plugin is being loaded */
    $this->rc = rcmail::get_instance();	
	/**
	 * Next we load our configuration file.
	 * If you load your configuration file like the following two lines, then you will always have
	 * default values for anything that you might setup in a configuration file
	 */
	$this->load_config('config.inc.php.dist');
	$this->load_config('config.inc.php');
	/** Next we load our own languagefiles for our custom strings */
    $this->add_texts('localization/');
  }
}