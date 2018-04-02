<?php

namespace Base;

use \MatrixItem as ChildMatrixItem;
use \MatrixItemQuery as ChildMatrixItemQuery;
use \Exception;
use \PDO;
use Map\MatrixItemTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'matrix_item' table.
 *
 *
 *
 * @method     ChildMatrixItemQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMatrixItemQuery orderByIdTicker($order = Criteria::ASC) Order by the id_ticker column
 * @method     ChildMatrixItemQuery orderByCurrencyFrom($order = Criteria::ASC) Order by the currency_from column
 * @method     ChildMatrixItemQuery orderByCurrencyTo($order = Criteria::ASC) Order by the currency_to column
 * @method     ChildMatrixItemQuery orderByFeeRate($order = Criteria::ASC) Order by the fee_rate column
 * @method     ChildMatrixItemQuery orderByConversionRate($order = Criteria::ASC) Order by the conversion_rate column
 * @method     ChildMatrixItemQuery orderByCodeOrderSideEnum($order = Criteria::ASC) Order by the code_order_side_enum column
 * @method     ChildMatrixItemQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildMatrixItemQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildMatrixItemQuery groupById() Group by the id column
 * @method     ChildMatrixItemQuery groupByIdTicker() Group by the id_ticker column
 * @method     ChildMatrixItemQuery groupByCurrencyFrom() Group by the currency_from column
 * @method     ChildMatrixItemQuery groupByCurrencyTo() Group by the currency_to column
 * @method     ChildMatrixItemQuery groupByFeeRate() Group by the fee_rate column
 * @method     ChildMatrixItemQuery groupByConversionRate() Group by the conversion_rate column
 * @method     ChildMatrixItemQuery groupByCodeOrderSideEnum() Group by the code_order_side_enum column
 * @method     ChildMatrixItemQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildMatrixItemQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildMatrixItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMatrixItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMatrixItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMatrixItemQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMatrixItemQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMatrixItemQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMatrixItemQuery leftJoinTicker($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ticker relation
 * @method     ChildMatrixItemQuery rightJoinTicker($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ticker relation
 * @method     ChildMatrixItemQuery innerJoinTicker($relationAlias = null) Adds a INNER JOIN clause to the query using the Ticker relation
 *
 * @method     ChildMatrixItemQuery joinWithTicker($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ticker relation
 *
 * @method     ChildMatrixItemQuery leftJoinWithTicker() Adds a LEFT JOIN clause and with to the query using the Ticker relation
 * @method     ChildMatrixItemQuery rightJoinWithTicker() Adds a RIGHT JOIN clause and with to the query using the Ticker relation
 * @method     ChildMatrixItemQuery innerJoinWithTicker() Adds a INNER JOIN clause and with to the query using the Ticker relation
 *
 * @method     ChildMatrixItemQuery leftJoinOrderSideEnum($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderSideEnum relation
 * @method     ChildMatrixItemQuery rightJoinOrderSideEnum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderSideEnum relation
 * @method     ChildMatrixItemQuery innerJoinOrderSideEnum($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderSideEnum relation
 *
 * @method     ChildMatrixItemQuery joinWithOrderSideEnum($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderSideEnum relation
 *
 * @method     ChildMatrixItemQuery leftJoinWithOrderSideEnum() Adds a LEFT JOIN clause and with to the query using the OrderSideEnum relation
 * @method     ChildMatrixItemQuery rightJoinWithOrderSideEnum() Adds a RIGHT JOIN clause and with to the query using the OrderSideEnum relation
 * @method     ChildMatrixItemQuery innerJoinWithOrderSideEnum() Adds a INNER JOIN clause and with to the query using the OrderSideEnum relation
 *
 * @method     \TickerQuery|\OrderSideEnumQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMatrixItem findOne(ConnectionInterface $con = null) Return the first ChildMatrixItem matching the query
 * @method     ChildMatrixItem findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMatrixItem matching the query, or a new ChildMatrixItem object populated from the query conditions when no match is found
 *
 * @method     ChildMatrixItem findOneById(int $id) Return the first ChildMatrixItem filtered by the id column
 * @method     ChildMatrixItem findOneByIdTicker(int $id_ticker) Return the first ChildMatrixItem filtered by the id_ticker column
 * @method     ChildMatrixItem findOneByCurrencyFrom(string $currency_from) Return the first ChildMatrixItem filtered by the currency_from column
 * @method     ChildMatrixItem findOneByCurrencyTo(string $currency_to) Return the first ChildMatrixItem filtered by the currency_to column
 * @method     ChildMatrixItem findOneByFeeRate(double $fee_rate) Return the first ChildMatrixItem filtered by the fee_rate column
 * @method     ChildMatrixItem findOneByConversionRate(double $conversion_rate) Return the first ChildMatrixItem filtered by the conversion_rate column
 * @method     ChildMatrixItem findOneByCodeOrderSideEnum(string $code_order_side_enum) Return the first ChildMatrixItem filtered by the code_order_side_enum column
 * @method     ChildMatrixItem findOneByCreatedAt(string $created_at) Return the first ChildMatrixItem filtered by the created_at column
 * @method     ChildMatrixItem findOneByUpdatedAt(string $updated_at) Return the first ChildMatrixItem filtered by the updated_at column *

 * @method     ChildMatrixItem requirePk($key, ConnectionInterface $con = null) Return the ChildMatrixItem by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMatrixItem requireOne(ConnectionInterface $con = null) Return the first ChildMatrixItem matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMatrixItem requireOneById(int $id) Return the first ChildMatrixItem filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMatrixItem requireOneByIdTicker(int $id_ticker) Return the first ChildMatrixItem filtered by the id_ticker column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMatrixItem requireOneByCurrencyFrom(string $currency_from) Return the first ChildMatrixItem filtered by the currency_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMatrixItem requireOneByCurrencyTo(string $currency_to) Return the first ChildMatrixItem filtered by the currency_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMatrixItem requireOneByFeeRate(double $fee_rate) Return the first ChildMatrixItem filtered by the fee_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMatrixItem requireOneByConversionRate(double $conversion_rate) Return the first ChildMatrixItem filtered by the conversion_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMatrixItem requireOneByCodeOrderSideEnum(string $code_order_side_enum) Return the first ChildMatrixItem filtered by the code_order_side_enum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMatrixItem requireOneByCreatedAt(string $created_at) Return the first ChildMatrixItem filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMatrixItem requireOneByUpdatedAt(string $updated_at) Return the first ChildMatrixItem filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMatrixItem[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMatrixItem objects based on current ModelCriteria
 * @method     ChildMatrixItem[]|ObjectCollection findById(int $id) Return ChildMatrixItem objects filtered by the id column
 * @method     ChildMatrixItem[]|ObjectCollection findByIdTicker(int $id_ticker) Return ChildMatrixItem objects filtered by the id_ticker column
 * @method     ChildMatrixItem[]|ObjectCollection findByCurrencyFrom(string $currency_from) Return ChildMatrixItem objects filtered by the currency_from column
 * @method     ChildMatrixItem[]|ObjectCollection findByCurrencyTo(string $currency_to) Return ChildMatrixItem objects filtered by the currency_to column
 * @method     ChildMatrixItem[]|ObjectCollection findByFeeRate(double $fee_rate) Return ChildMatrixItem objects filtered by the fee_rate column
 * @method     ChildMatrixItem[]|ObjectCollection findByConversionRate(double $conversion_rate) Return ChildMatrixItem objects filtered by the conversion_rate column
 * @method     ChildMatrixItem[]|ObjectCollection findByCodeOrderSideEnum(string $code_order_side_enum) Return ChildMatrixItem objects filtered by the code_order_side_enum column
 * @method     ChildMatrixItem[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildMatrixItem objects filtered by the created_at column
 * @method     ChildMatrixItem[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildMatrixItem objects filtered by the updated_at column
 * @method     ChildMatrixItem[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MatrixItemQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MatrixItemQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'analizoexchangeapitester', $modelName = '\\MatrixItem', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMatrixItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMatrixItemQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMatrixItemQuery) {
            return $criteria;
        }
        $query = new ChildMatrixItemQuery();
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
     * @return ChildMatrixItem|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MatrixItemTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MatrixItemTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMatrixItem A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_ticker`, `currency_from`, `currency_to`, `fee_rate`, `conversion_rate`, `code_order_side_enum`, `created_at`, `updated_at` FROM `matrix_item` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildMatrixItem $obj */
            $obj = new ChildMatrixItem();
            $obj->hydrate($row);
            MatrixItemTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMatrixItem|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MatrixItemTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MatrixItemTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatrixItemTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_ticker column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTicker(1234); // WHERE id_ticker = 1234
     * $query->filterByIdTicker(array(12, 34)); // WHERE id_ticker IN (12, 34)
     * $query->filterByIdTicker(array('min' => 12)); // WHERE id_ticker > 12
     * </code>
     *
     * @see       filterByTicker()
     *
     * @param     mixed $idTicker The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByIdTicker($idTicker = null, $comparison = null)
    {
        if (is_array($idTicker)) {
            $useMinMax = false;
            if (isset($idTicker['min'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_ID_TICKER, $idTicker['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTicker['max'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_ID_TICKER, $idTicker['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatrixItemTableMap::COL_ID_TICKER, $idTicker, $comparison);
    }

    /**
     * Filter the query on the currency_from column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyFrom('fooValue');   // WHERE currency_from = 'fooValue'
     * $query->filterByCurrencyFrom('%fooValue%', Criteria::LIKE); // WHERE currency_from LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currencyFrom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByCurrencyFrom($currencyFrom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currencyFrom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatrixItemTableMap::COL_CURRENCY_FROM, $currencyFrom, $comparison);
    }

    /**
     * Filter the query on the currency_to column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyTo('fooValue');   // WHERE currency_to = 'fooValue'
     * $query->filterByCurrencyTo('%fooValue%', Criteria::LIKE); // WHERE currency_to LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currencyTo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByCurrencyTo($currencyTo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currencyTo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatrixItemTableMap::COL_CURRENCY_TO, $currencyTo, $comparison);
    }

    /**
     * Filter the query on the fee_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByFeeRate(1234); // WHERE fee_rate = 1234
     * $query->filterByFeeRate(array(12, 34)); // WHERE fee_rate IN (12, 34)
     * $query->filterByFeeRate(array('min' => 12)); // WHERE fee_rate > 12
     * </code>
     *
     * @param     mixed $feeRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByFeeRate($feeRate = null, $comparison = null)
    {
        if (is_array($feeRate)) {
            $useMinMax = false;
            if (isset($feeRate['min'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_FEE_RATE, $feeRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($feeRate['max'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_FEE_RATE, $feeRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatrixItemTableMap::COL_FEE_RATE, $feeRate, $comparison);
    }

    /**
     * Filter the query on the conversion_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByConversionRate(1234); // WHERE conversion_rate = 1234
     * $query->filterByConversionRate(array(12, 34)); // WHERE conversion_rate IN (12, 34)
     * $query->filterByConversionRate(array('min' => 12)); // WHERE conversion_rate > 12
     * </code>
     *
     * @param     mixed $conversionRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByConversionRate($conversionRate = null, $comparison = null)
    {
        if (is_array($conversionRate)) {
            $useMinMax = false;
            if (isset($conversionRate['min'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_CONVERSION_RATE, $conversionRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($conversionRate['max'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_CONVERSION_RATE, $conversionRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatrixItemTableMap::COL_CONVERSION_RATE, $conversionRate, $comparison);
    }

    /**
     * Filter the query on the code_order_side_enum column
     *
     * Example usage:
     * <code>
     * $query->filterByCodeOrderSideEnum('fooValue');   // WHERE code_order_side_enum = 'fooValue'
     * $query->filterByCodeOrderSideEnum('%fooValue%', Criteria::LIKE); // WHERE code_order_side_enum LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codeOrderSideEnum The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByCodeOrderSideEnum($codeOrderSideEnum = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codeOrderSideEnum)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatrixItemTableMap::COL_CODE_ORDER_SIDE_ENUM, $codeOrderSideEnum, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatrixItemTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MatrixItemTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MatrixItemTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Ticker object
     *
     * @param \Ticker|ObjectCollection $ticker The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByTicker($ticker, $comparison = null)
    {
        if ($ticker instanceof \Ticker) {
            return $this
                ->addUsingAlias(MatrixItemTableMap::COL_ID_TICKER, $ticker->getId(), $comparison);
        } elseif ($ticker instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MatrixItemTableMap::COL_ID_TICKER, $ticker->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTicker() only accepts arguments of type \Ticker or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ticker relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function joinTicker($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ticker');

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
            $this->addJoinObject($join, 'Ticker');
        }

        return $this;
    }

    /**
     * Use the Ticker relation Ticker object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TickerQuery A secondary query class using the current class as primary query
     */
    public function useTickerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTicker($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ticker', '\TickerQuery');
    }

    /**
     * Filter the query by a related \OrderSideEnum object
     *
     * @param \OrderSideEnum|ObjectCollection $orderSideEnum The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMatrixItemQuery The current query, for fluid interface
     */
    public function filterByOrderSideEnum($orderSideEnum, $comparison = null)
    {
        if ($orderSideEnum instanceof \OrderSideEnum) {
            return $this
                ->addUsingAlias(MatrixItemTableMap::COL_CODE_ORDER_SIDE_ENUM, $orderSideEnum->getCode(), $comparison);
        } elseif ($orderSideEnum instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MatrixItemTableMap::COL_CODE_ORDER_SIDE_ENUM, $orderSideEnum->toKeyValue('PrimaryKey', 'Code'), $comparison);
        } else {
            throw new PropelException('filterByOrderSideEnum() only accepts arguments of type \OrderSideEnum or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderSideEnum relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function joinOrderSideEnum($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderSideEnum');

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
            $this->addJoinObject($join, 'OrderSideEnum');
        }

        return $this;
    }

    /**
     * Use the OrderSideEnum relation OrderSideEnum object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderSideEnumQuery A secondary query class using the current class as primary query
     */
    public function useOrderSideEnumQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderSideEnum($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderSideEnum', '\OrderSideEnumQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMatrixItem $matrixItem Object to remove from the list of results
     *
     * @return $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function prune($matrixItem = null)
    {
        if ($matrixItem) {
            $this->addUsingAlias(MatrixItemTableMap::COL_ID, $matrixItem->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the matrix_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MatrixItemTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MatrixItemTableMap::clearInstancePool();
            MatrixItemTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MatrixItemTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MatrixItemTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MatrixItemTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MatrixItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(MatrixItemTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(MatrixItemTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(MatrixItemTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(MatrixItemTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(MatrixItemTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildMatrixItemQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(MatrixItemTableMap::COL_CREATED_AT);
    }

} // MatrixItemQuery
