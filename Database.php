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
	 * checkDb($tableName) - check Database connection, as well if $tableName(s) exist(s)
	 * @array $tableNames
	 * 
	 * @return true/false
	 */
	public static function checkDb($tableNames=[], $fieldNames=[])
	{
        // $connection = Yii::$app->db->isActive;//always returns bool(false)
        try {
        	// database connection
        	Yii::$app->db->open();
			
			$array = [];
			// database table
			if (!empty($tableNames)) {
				foreach ($tableNames as $tableName) {
					if (Yii::$app->db->schema->getTableSchema($tableName, true) === null) {
						$array[] = $tableName;
					}
				}//foreach()
				if (count($array) == 1) {
					Yii::$app->session->setFlash('error', 
						'<i class="fa fa-warning"></i> ' . 
						Yii::t('main', 'Table \'{tableName}\' does not exist.', [
							'tableName' => $tableName
						])
					);
					return false;
				}
				if (count($array) > 1) {
					// get last value from array
					$lastitem = end($array);
					// remove last value from array
					$items = array_slice($array, 0, count($array)-1);
					$itemstring = implode(", ", $items);
					Yii::$app->session->setFlash('error', 
						'<i class="fa fa-warning"></i> ' . 
						Yii::t('main', 'Tables \'{tableNames} and {lastTableName}\' do not exist.', [
							'tableNames' => $itemstring,
							'lastTableName' => $lastitem,
						])
					);
					return false;
				}
				return true;
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
