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
	 *
	 * To use multiple tasks for a single plugin, seperate them with a pipe symbol.
	 * For example: login|mail|settings
	 *
	 * For demo purposes, we use only settings in our demo
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
  function init()
  {
	/**
	 * First we need to get a instance to the current working roundcube in which out plugin is being loaded
	 * Now $this->rc holds all global roundcube items
	 */
    $this->rc = rcmail::get_instance();	
	/**
	 * Next we load our configuration file.
	 * If you load your configuration file like the following two lines, then you will always have
	 * default values for anything that you might setup in a configuration file
	 */
	$this->load_config('config.inc.php.dist');
	$this->load_config('config.inc.php');
	/**
	 * Next we load our own languagefiles for our custom strings
	 */
    $this->add_texts('localization/');
	/**
	 * Now we can do any of the following items:
	 * Add hooks: $this->add_hook('some_hook', array($this, 'name_of_internal_function'));
	 * Register Actions: $this->register_action('plugin.someaction', array($this, 'name_of_internal_function'));
	 * or your own stuff that you want to do in the init section of the plugin.
	 * For this demo, we are going to add an item to the settings page.
	 */
	 $this->register_action('plugin.demo-plugin', array($this, 'demo_init'));
	 /**
	  * Now we register our plugin into the Roundcube instance using the label
	  */
	 $this->rc->output->add_label('demo_plugin');
  }
  
	/**
	 * This is the function we defined above in the register_action line
	 */
  function demo_init()
  {
	/**
	 * The following line does 2 things:
	 * 1. It sets the pagetitle $this->rc->output->set_pagetitle()
	 * 2. it gets a specific line of text from the language file $this->gettext('title')
	 */
    $this->rc->output->set_pagetitle($this->gettext('title'));
	/**
	 * Now we set a handler (what to do when the plugin is called for)
	 * In our example, we are going to send some specific HTML code using built in Roundcube functions
	 */
    $this->register_handler('plugin.body', array($this, 'filters_form'));
	/**
	 * We do have to make sure we send all data using the line below
	 */
	$this->rc->output->send('plugin');
  }
}