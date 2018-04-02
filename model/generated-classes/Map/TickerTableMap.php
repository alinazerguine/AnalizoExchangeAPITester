<?php

namespace Map;

use \Ticker;
use \TickerQuery;
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
 * This class defines the structure of the 'ticker' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class TickerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.TickerTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'analizoexchangeapitester';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'ticker';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Ticker';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Ticker';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the id field
     */
    const COL_ID = 'ticker.id';

    /**
     * the column name for the exchange_name field
     */
    const COL_EXCHANGE_NAME = 'ticker.exchange_name';

    /**
     * the column name for the symbol field
     */
    const COL_SYMBOL = 'ticker.symbol';

    /**
     * the column name for the currency_base field
     */
    const COL_CURRENCY_BASE = 'ticker.currency_base';

    /**
     * the column name for the currency_quote field
     */
    const COL_CURRENCY_QUOTE = 'ticker.currency_quote';

    /**
     * the column name for the bid field
     */
    const COL_BID = 'ticker.bid';

    /**
     * the column name for the ask field
     */
    const COL_ASK = 'ticker.ask';

    /**
     * the column name for the last field
     */
    const COL_LAST = 'ticker.last';

    /**
     * the column name for the open field
     */
    const COL_OPEN = 'ticker.open';

    /**
     * the column name for the high field
     */
    const COL_HIGH = 'ticker.high';

    /**
     * the column name for the low field
     */
    const COL_LOW = 'ticker.low';

    /**
     * the column name for the volume field
     */
    const COL_VOLUME = 'ticker.volume';

    /**
     * the column name for the fee_rate_buy field
     */
    const COL_FEE_RATE_BUY = 'ticker.fee_rate_buy';

    /**
     * the column name for the fee_rate_sell field
     */
    const COL_FEE_RATE_SELL = 'ticker.fee_rate_sell';

    /**
     * the column name for the is_active field
     */
    const COL_IS_ACTIVE = 'ticker.is_active';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'ticker.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'ticker.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'ExchangeName', 'Symbol', 'CurrencyBase', 'CurrencyQuote', 'Bid', 'Ask', 'Last', 'Open', 'High', 'Low', 'Volume', 'FeeRateBuy', 'FeeRateSell', 'IsActive', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'exchangeName', 'symbol', 'currencyBase', 'currencyQuote', 'bid', 'ask', 'last', 'open', 'high', 'low', 'volume', 'feeRateBuy', 'feeRateSell', 'isActive', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(TickerTableMap::COL_ID, TickerTableMap::COL_EXCHANGE_NAME, TickerTableMap::COL_SYMBOL, TickerTableMap::COL_CURRENCY_BASE, TickerTableMap::COL_CURRENCY_QUOTE, TickerTableMap::COL_BID, TickerTableMap::COL_ASK, TickerTableMap::COL_LAST, TickerTableMap::COL_OPEN, TickerTableMap::COL_HIGH, TickerTableMap::COL_LOW, TickerTableMap::COL_VOLUME, TickerTableMap::COL_FEE_RATE_BUY, TickerTableMap::COL_FEE_RATE_SELL, TickerTableMap::COL_IS_ACTIVE, TickerTableMap::COL_CREATED_AT, TickerTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'exchange_name', 'symbol', 'currency_base', 'currency_quote', 'bid', 'ask', 'last', 'open', 'high', 'low', 'volume', 'fee_rate_buy', 'fee_rate_sell', 'is_active', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ExchangeName' => 1, 'Symbol' => 2, 'CurrencyBase' => 3, 'CurrencyQuote' => 4, 'Bid' => 5, 'Ask' => 6, 'Last' => 7, 'Open' => 8, 'High' => 9, 'Low' => 10, 'Volume' => 11, 'FeeRateBuy' => 12, 'FeeRateSell' => 13, 'IsActive' => 14, 'CreatedAt' => 15, 'UpdatedAt' => 16, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'exchangeName' => 1, 'symbol' => 2, 'currencyBase' => 3, 'currencyQuote' => 4, 'bid' => 5, 'ask' => 6, 'last' => 7, 'open' => 8, 'high' => 9, 'low' => 10, 'volume' => 11, 'feeRateBuy' => 12, 'feeRateSell' => 13, 'isActive' => 14, 'createdAt' => 15, 'updatedAt' => 16, ),
        self::TYPE_COLNAME       => array(TickerTableMap::COL_ID => 0, TickerTableMap::COL_EXCHANGE_NAME => 1, TickerTableMap::COL_SYMBOL => 2, TickerTableMap::COL_CURRENCY_BASE => 3, TickerTableMap::COL_CURRENCY_QUOTE => 4, TickerTableMap::COL_BID => 5, TickerTableMap::COL_ASK => 6, TickerTableMap::COL_LAST => 7, TickerTableMap::COL_OPEN => 8, TickerTableMap::COL_HIGH => 9, TickerTableMap::COL_LOW => 10, TickerTableMap::COL_VOLUME => 11, TickerTableMap::COL_FEE_RATE_BUY => 12, TickerTableMap::COL_FEE_RATE_SELL => 13, TickerTableMap::COL_IS_ACTIVE => 14, TickerTableMap::COL_CREATED_AT => 15, TickerTableMap::COL_UPDATED_AT => 16, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'exchange_name' => 1, 'symbol' => 2, 'currency_base' => 3, 'currency_quote' => 4, 'bid' => 5, 'ask' => 6, 'last' => 7, 'open' => 8, 'high' => 9, 'low' => 10, 'volume' => 11, 'fee_rate_buy' => 12, 'fee_rate_sell' => 13, 'is_active' => 14, 'created_at' => 15, 'updated_at' => 16, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
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
        $this->setName('ticker');
        $this->setPhpName('Ticker');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Ticker');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('exchange_name', 'ExchangeName', 'VARCHAR', true, 255, null);
        $this->addColumn('symbol', 'Symbol', 'VARCHAR', true, 255, null);
        $this->addColumn('currency_base', 'CurrencyBase', 'VARCHAR', true, 10, null);
        $this->addColumn('currency_quote', 'CurrencyQuote', 'VARCHAR', true, 10, null);
        $this->addColumn('bid', 'Bid', 'DOUBLE', true, null, null);
        $this->addColumn('ask', 'Ask', 'DOUBLE', true, null, null);
        $this->addColumn('last', 'Last', 'DOUBLE', false, null, null);
        $this->addColumn('open', 'Open', 'DOUBLE', false, null, null);
        $this->addColumn('high', 'High', 'DOUBLE', false, null, null);
        $this->addColumn('low', 'Low', 'DOUBLE', false, null, null);
        $this->addColumn('volume', 'Volume', 'DOUBLE', false, null, null);
        $this->addColumn('fee_rate_buy', 'FeeRateBuy', 'DOUBLE', true, null, null);
        $this->addColumn('fee_rate_sell', 'FeeRateSell', 'DOUBLE', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('MatrixItem', '\\MatrixItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_ticker',
    1 => ':id',
  ),
), 'CASCADE', null, 'MatrixItems', false);
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
     * Method to invalidate the instance pool of all tables related to ticker     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        MatrixItemTableMap::clearInstancePool();
    }

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
        return $withPrefix ? TickerTableMap::CLASS_DEFAULT : TickerTableMap::OM_CLASS;
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
     * @return array           (Ticker object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = TickerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TickerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TickerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TickerTableMap::OM_CLASS;
            /** @var Ticker $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TickerTableMap::addInstanceToPool($obj, $key);
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
            $key = TickerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TickerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Ticker $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TickerTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TickerTableMap::COL_ID);
            $criteria->addSelectColumn(TickerTableMap::COL_EXCHANGE_NAME);
            $criteria->addSelectColumn(TickerTableMap::COL_SYMBOL);
            $criteria->addSelectColumn(TickerTableMap::COL_CURRENCY_BASE);
            $criteria->addSelectColumn(TickerTableMap::COL_CURRENCY_QUOTE);
            $criteria->addSelectColumn(TickerTableMap::COL_BID);
            $criteria->addSelectColumn(TickerTableMap::COL_ASK);
            $criteria->addSelectColumn(TickerTableMap::COL_LAST);
            $criteria->addSelectColumn(TickerTableMap::COL_OPEN);
            $criteria->addSelectColumn(TickerTableMap::COL_HIGH);
            $criteria->addSelectColumn(TickerTableMap::COL_LOW);
            $criteria->addSelectColumn(TickerTableMap::COL_VOLUME);
            $criteria->addSelectColumn(TickerTableMap::COL_FEE_RATE_BUY);
            $criteria->addSelectColumn(TickerTableMap::COL_FEE_RATE_SELL);
            $criteria->addSelectColumn(TickerTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(TickerTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TickerTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.exchange_name');
            $criteria->addSelectColumn($alias . '.symbol');
            $criteria->addSelectColumn($alias . '.currency_base');
            $criteria->addSelectColumn($alias . '.currency_quote');
            $criteria->addSelectColumn($alias . '.bid');
            $criteria->addSelectColumn($alias . '.ask');
            $criteria->addSelectColumn($alias . '.last');
            $criteria->addSelectColumn($alias . '.open');
            $criteria->addSelectColumn($alias . '.high');
            $criteria->addSelectColumn($alias . '.low');
            $criteria->addSelectColumn($alias . '.volume');
            $criteria->addSelectColumn($alias . '.fee_rate_buy');
            $criteria->addSelectColumn($alias . '.fee_rate_sell');
            $criteria->addSelectColumn($alias . '.is_active');
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
        return Propel::getServiceContainer()->getDatabaseMap(TickerTableMap::DATABASE_NAME)->getTable(TickerTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(TickerTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(TickerTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new TickerTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Ticker or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Ticker object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TickerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Ticker) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TickerTableMap::DATABASE_NAME);
            $criteria->add(TickerTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = TickerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TickerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TickerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ticker table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return TickerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Ticker or Criteria object.
     *
     * @param mixed               $criteria Criteria or Ticker object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TickerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Ticker object
        }

        if ($criteria->containsKey(TickerTableMap::COL_ID) && $criteria->keyContainsValue(TickerTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TickerTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = TickerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // TickerTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
TickerTableMap::buildTableMap();
