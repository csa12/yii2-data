<?php
/**
 * @copyright Copyright &copy; Marc Huizinga, CSA, 2015
 * @package yii2-data
 * @version 0.0.1
 */

namespace csa\data;

use Yii;
//use yii\web\Controller;

//use yii\base\ErrorException;
use yii\db\Exception;

/**
 * CSA Database additions..
 */
class Database
{
	/**
	 * Check for database connection && if required table exists
	 * Comes in handy when swiching between development environments
	 * use yii\db\Exception;
	 * 
	 * checkDb() - only check Database connection
	 * checkDb($tableName) - check Database connection, as well if $tableName exists
	 * @return true/false
	 */
	public static function checkDb($tableName=null)
	{
        // $connection = Yii::$app->db->isActive;//always returns bool(false)
        try {
        	// database connection
        	Yii::$app->db->open();
			
			// database table
			if ($tableName) {
				if (Yii::$app->db->schema->getTableSchema($tableName, true) === null) {
					Yii::$app->session->setFlash('error', 
						'<i class="fa fa-warning"></i> ' . 
						Yii::t('main', 'Table \'{tableName}\' does not exist', [
							'tableName' => $tableName
						])
					);
					return false;
				} else {
					// $tableName exists
					return true;
				}
			}
			// database connection
			return true;
        } catch (Exception $e) {
			//echo 'exception = ' . $e;
			Yii::$app->session->setFlash('error', 
				'<i class="fa fa-warning"></i> ' . 
				Yii::t('main', 'Unable to connect to database')
			);
			return false;
        }
	}
}
