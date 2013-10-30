<?php

/**
 * Data Access Object (DAO) for messages.
 *	Performs operations on database.
 * @author Madhouse
 * @package Madhouse_HelloWorld
 * @subpackage Model
 * @since 1.00
 */
class Madhouse_HelloWorld_Model_Message extends DAO {
	
	function __construct() {
	    parent::__construct();
	    $this->setTableName('t_mdh_helloworld_message');
	    $this->setPrimaryKey('pk_i_id');
	    $this->setFields(array('pk_i_id', 's_content'));
	}
	
	/**
	 * Singleton.
	 */
	private static $instance;

	/**
	 * Singleton constructor.
	 * @return an MadhouseMessengerDAO object.
	 */
	public static function newInstance() {
		if(!self::$instance instanceof self) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	/**
	 * Performs install tasks on the database.
	 * @throws Exception if the SQL file is not found or if the import has failed.
	 * @since 1.00
	 */
	public function install() {
		// Get the content of the file. 'mdh_current_plugin_path' throws an exception if the file does not exist.
		$sql = file_get_contents(mdh_current_plugin_path("assets/model/install.sql", false));

		// Try to import them. Throws Exception if failure.
		if(! $this->dao->importSQL($sql)){
			throw new Exception("Failed installing '" . $this->dao->getErrorDesc() . "'");
		}
	}
	
	/**
	 * Performs uninstall tasks on the database.
	 * @throws Exception if the SQL file is not found or if the import has failed.
	 * @since 1.00
	 */
	public function uninstall() {
		// Get the content of the file. 'mdh_current_plugin_path' throws an exception if the file does not exist.
		$sql = file_get_contents(mdh_current_plugin_path("assets/model/uninstall.sql", false));

		// Try to import them. Throws Exception if failure.
		if(! $this->dao->importSQL($sql)){
			throw new Exception("Failed installing '" . $this->dao->getErrorDesc() . "'");
		}
	}
}

?>