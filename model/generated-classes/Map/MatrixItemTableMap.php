<?php

namespace Map;

use \MatrixItem;
use \MatrixItemQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'matrix_item' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MatrixItemTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.MatrixItemTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'analizoexchangeapitester';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'matrix_item';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\MatrixItem';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'MatrixItem';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    const COL_ID = 'matrix_item.id';

    /**
     * the column name for the id_ticker field
     */
    const COL_ID_TICKER = 'matrix_item.id_ticker';

    /**
     * the column name for the currency_from field
     */
    const COL_CURRENCY_FROM = 'matrix_item.currency_from';

    /**
     * the column name for the currency_to field
     */
    const COL_CURRENCY_TO = 'matrix_item.currency_to';

    /**
     * the column name for the fee_rate field
     */
    const COL_FEE_RATE = 'matrix_item.fee_rate';

    /**
     * the column name for the conversion_rate field
     */
    const COL_CONVERSION_RATE = 'matrix_item.conversion_rate';

    /**
     * the column name for the code_order_side_enum field
     */
    const COL_CODE_ORDER_SIDE_ENUM = 'matrix_item.code_order_side_enum';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'matrix_item.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'matrix_item.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'IdTicker', 'CurrencyFrom', 'CurrencyTo', 'FeeRate', 'ConversionRate', 'CodeOrderSideEnum', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idTicker', 'currencyFrom', 'currencyTo', 'feeRate', 'conversionRate', 'codeOrderSideEnum', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(MatrixItemTableMap::COL_ID, MatrixItemTableMap::COL_ID_TICKER, MatrixItemTableMap::COL_CURRENCY_FROM, MatrixItemTableMap::COL_CURRENCY_TO, MatrixItemTableMap::COL_FEE_RATE, MatrixItemTableMap::COL_CONVERSION_RATE, MatrixItemTableMap::COL_CODE_ORDER_SIDE_ENUM, MatrixItemTableMap::COL_CREATED_AT, MatrixItemTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_ticker', 'currency_from', 'currency_to', 'fee_rate', 'conversion_rate', 'code_order_side_enum', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdTicker' => 1, 'CurrencyFrom' => 2, 'CurrencyTo' => 3, 'FeeRate' => 4, 'ConversionRate' => 5, 'CodeOrderSideEnum' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idTicker' => 1, 'currencyFrom' => 2, 'currencyTo' => 3, 'feeRate' => 4, 'conversionRate' => 5, 'codeOrderSideEnum' => 6, 'createdAt' => 7, 'updatedAt' => 8, ),
        self::TYPE_COLNAME       => array(MatrixItemTableMap::COL_ID => 0, MatrixItemTableMap::COL_ID_TICKER => 1, MatrixItemTableMap::COL_CURRENCY_FROM => 2, MatrixItemTableMap::COL_CURRENCY_TO => 3, MatrixItemTableMap::COL_FEE_RATE => 4, MatrixItemTableMap::COL_CONVERSION_RATE => 5, MatrixItemTableMap::COL_CODE_ORDER_SIDE_ENUM => 6, MatrixItemTableMap::COL_CREATED_AT => 7, MatrixItemTableMap::COL_UPDATED_AT => 8, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_ticker' => 1, 'currency_from' => 2, 'currency_to' => 3, 'fee_rate' => 4, 'conversion_rate' => 5, 'code_order_side_enum' => 6, 'created_at' => 7, 'updated_at' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('matrix_item');
        $this->setPhpName('MatrixItem');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\MatrixItem');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('id_ticker', 'IdTicker', 'INTEGER', 'ticker', 'id', true, null, null);
        $this->addColumn('currency_from', 'CurrencyFrom', 'VARCHAR', true, 10, null);
        $this->addColumn('currency_to', 'CurrencyTo', 'VARCHAR', true, 10, null);
        $this->addColumn('fee_rate', 'FeeRate', 'DOUBLE', true, null, null);
        $this->addColumn('conversion_rate', 'ConversionRate', 'FLOAT', true, null, null);
        $this->addForeignKey('code_order_side_enum', 'CodeOrderSideEnum', 'VARCHAR', 'ordersideenum', 'code', true, 20, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Ticker', '\\Ticker', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_ticker',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('OrderSideEnum', '\\OrderSideEnum', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':code_order_side_enum',
    1 => ':code',
  ),
), null, null, null, false);
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
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? MatrixItemTableMap::CLASS_DEFAULT : MatrixItemTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (MatrixItem object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MatrixItemTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MatrixItemTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MatrixItemTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MatrixItemTableMap::OM_CLASS;
            /** @var MatrixItem $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MatrixItemTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = MatrixItemTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MatrixItemTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MatrixItem $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MatrixItemTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(MatrixItemTableMap::COL_ID);
            $criteria->addSelectColumn(MatrixItemTableMap::COL_ID_TICKER);
            $criteria->addSelectColumn(MatrixItemTableMap::COL_CURRENCY_FROM);
            $criteria->addSelectColumn(MatrixItemTableMap::COL_CURRENCY_TO);
            $criteria->addSelectColumn(MatrixItemTableMap::COL_FEE_RATE);
            $criteria->addSelectColumn(MatrixItemTableMap::COL_CONVERSION_RATE);
            $criteria->addSelectColumn(MatrixItemTableMap::COL_CODE_ORDER_SIDE_ENUM);
            $criteria->addSelectColumn(MatrixItemTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(MatrixItemTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_ticker');
            $criteria->addSelectColumn($alias . '.currency_from');
            $criteria->addSelectColumn($alias . '.currency_to');
            $criteria->addSelectColumn($alias . '.fee_rate');
            $criteria->addSelectColumn($alias . '.conversion_rate');
            $criteria->addSelectColumn($alias . '.code_order_side_enum');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(MatrixItemTableMap::DATABASE_NAME)->getTable(MatrixItemTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MatrixItemTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MatrixItemTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MatrixItemTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a MatrixItem or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or MatrixItem object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MatrixItemTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \MatrixItem) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MatrixItemTableMap::DATABASE_NAME);
            $criteria->add(MatrixItemTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = MatrixItemQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MatrixItemTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MatrixItemTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the matrix_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MatrixItemQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MatrixItem or Criteria object.
     *
     * @param mixed               $criteria Criteria or MatrixItem object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MatrixItemTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MatrixItem object
        }

        if ($criteria->containsKey(MatrixItemTableMap::COL_ID) && $criteria->keyContainsValue(MatrixItemTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MatrixItemTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = MatrixItemQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MatrixItemTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MatrixItemTableMap::buildTableMap();
