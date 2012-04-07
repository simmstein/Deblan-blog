<?php


/**
 * This class defines the structure of the 'sf_asset_folder' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Mar  7 15:53:42 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.sfAssetsLibraryPlugin.lib.model.map
 */
class sfAssetFolderTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfAssetsLibraryPlugin.lib.model.map.sfAssetFolderTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('sf_asset_folder');
		$this->setPhpName('sfAssetFolder');
		$this->setClassname('sfAssetFolder');
		$this->setPackage('plugins.sfAssetsLibraryPlugin.lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('TREE_LEFT', 'TreeLeft', 'INTEGER', true, null, 0);
		$this->addColumn('TREE_RIGHT', 'TreeRight', 'INTEGER', true, null, 0);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('RELATIVE_PATH', 'RelativePath', 'VARCHAR', false, 255, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Asset', 'sfAsset', RelationMap::ONE_TO_MANY, array('id' => 'folder_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // sfAssetFolderTableMap
