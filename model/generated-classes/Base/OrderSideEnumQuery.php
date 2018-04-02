<?php

namespace Base;

use \OrderSideEnum as ChildOrderSideEnum;
use \OrderSideEnumQuery as ChildOrderSideEnumQuery;
use \Exception;
use \PDO;
use Map\OrderSideEnumTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ordersideenum' table.
 *
 *
 *
 * @method     ChildOrderSideEnumQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildOrderSideEnumQuery orderByDescriptionEn($order = Criteria::ASC) Order by the description_en column
 *
 * @method     ChildOrderSideEnumQuery groupByCode() Group by the code column
 * @method     ChildOrderSideEnumQuery groupByDescriptionEn() Group by the description_en column
 *
 * @method     ChildOrderSideEnumQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderSideEnumQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderSideEnumQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderSideEnumQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderSideEnumQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderSideEnumQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderSideEnumQuery leftJoinMatrixItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the MatrixItem relation
 * @method     ChildOrderSideEnumQuery rightJoinMatrixItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MatrixItem relation
 * @method     ChildOrderSideEnumQuery innerJoinMatrixItem($relationAlias = null) Adds a INNER JOIN clause to the query using the MatrixItem relation
 *
 * @method     ChildOrderSideEnumQuery joinWithMatrixItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MatrixItem relation
 *
 * @method     ChildOrderSideEnumQuery leftJoinWithMatrixItem() Adds a LEFT JOIN clause and with to the query using the MatrixItem relation
 * @method     ChildOrderSideEnumQuery rightJoinWithMatrixItem() Adds a RIGHT JOIN clause and with to the query using the MatrixItem relation
 * @method     ChildOrderSideEnumQuery innerJoinWithMatrixItem() Adds a INNER JOIN clause and with to the query using the MatrixItem relation
 *
 * @method     \MatrixItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderSideEnum findOne(ConnectionInterface $con = null) Return the first ChildOrderSideEnum matching the query
 * @method     ChildOrderSideEnum findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrderSideEnum matching the query, or a new ChildOrderSideEnum object populated from the query conditions when no match is found
 *
 * @method     ChildOrderSideEnum findOneByCode(string $code) Return the first ChildOrderSideEnum filtered by the code column
 * @method     ChildOrderSideEnum findOneByDescriptionEn(string $description_en) Return the first ChildOrderSideEnum filtered by the description_en column *

 * @method     ChildOrderSideEnum requirePk($key, ConnectionInterface $con = null) Return the ChildOrderSideEnum by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderSideEnum requireOne(ConnectionInterface $con = null) Return the first ChildOrderSideEnum matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderSideEnum requireOneByCode(string $code) Return the first ChildOrderSideEnum filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderSideEnum requireOneByDescriptionEn(string $description_en) Return the first ChildOrderSideEnum filtered by the description_en column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderSideEnum[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrderSideEnum objects based on current ModelCriteria
 * @method     ChildOrderSideEnum[]|ObjectCollection findByCode(string $code) Return ChildOrderSideEnum objects filtered by the code column
 * @method     ChildOrderSideEnum[]|ObjectCollection findByDescriptionEn(string $description_en) Return ChildOrderSideEnum objects filtered by the description_en column
 * @method     ChildOrderSideEnum[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderSideEnumQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrderSideEnumQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'analizoexchangeapitester', $modelName = '\\OrderSideEnum', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderSideEnumQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderSideEnumQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrderSideEnumQuery) {
            return $criteria;
        }
        $query = new ChildOrderSideEnumQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildOrderSideEnum|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderSideEnumTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderSideEnumTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderSideEnum A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `code`, `description_en` FROM `ordersideenum` WHERE `code` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildOrderSideEnum $obj */
            $obj = new ChildOrderSideEnum();
            $obj->hydrate($row);
            OrderSideEnumTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildOrderSideEnum|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildOrderSideEnumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OrderSideEnumTableMap::COL_CODE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrderSideEnumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OrderSideEnumTableMap::COL_CODE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderSideEnumQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderSideEnumTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the description_en column
     *
     * Example usage:
     * <code>
     * $query->filterByDescriptionEn('fooValue');   // WHERE description_en = 'fooValue'
     * $query->filterByDescriptionEn('%fooValue%', Criteria::LIKE); // WHERE description_en LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descriptionEn The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderSideEnumQuery The current query, for fluid interface
     */
    public function filterByDescriptionEn($descriptionEn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descriptionEn)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderSideEnumTableMap::COL_DESCRIPTION_EN, $descriptionEn, $comparison);
    }

    /**
     * Filter the query by a related \MatrixItem object
     *
     * @param \MatrixItem|ObjectCollection $matrixItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrderSideEnumQuery The current query, for fluid interface
     */
    public function filterByMatrixItem($matrixItem, $comparison = null)
    {
        if ($matrixItem instanceof \MatrixItem) {
            return $this
                ->addUsingAlias(OrderSideEnumTableMap::COL_CODE, $matrixItem->getCodeOrderSideEnum(), $comparison);
        } elseif ($matrixItem instanceof ObjectCollection) {
            return $this
                ->useMatrixItemQuery()
                ->filterByPrimaryKeys($matrixItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMatrixItem() only accepts arguments of type \MatrixItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MatrixItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderSideEnumQuery The current query, for fluid interface
     */
    public function joinMatrixItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MatrixItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'MatrixItem');
        }

        return $this;
    }

    /**
     * Use the MatrixItem relation MatrixItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MatrixItemQuery A secondary query class using the current class as primary query
     */
    public function useMatrixItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMatrixItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MatrixItem', '\MatrixItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOrderSideEnum $orderSideEnum Object to remove from the list of results
     *
     * @return $this|ChildOrderSideEnumQuery The current query, for fluid interface
     */
    public function prune($orderSideEnum = null)
    {
        if ($orderSideEnum) {
            $this->addUsingAlias(OrderSideEnumTableMap::COL_CODE, $orderSideEnum->getCode(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ordersideenum table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderSideEnumTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderSideEnumTableMap::clearInstancePool();
            OrderSideEnumTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderSideEnumTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderSideEnumTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderSideEnumTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderSideEnumTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrderSideEnumQuery
