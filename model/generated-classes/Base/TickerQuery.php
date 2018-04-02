<?php

namespace Base;

use \Ticker as ChildTicker;
use \TickerQuery as ChildTickerQuery;
use \Exception;
use \PDO;
use Map\TickerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ticker' table.
 *
 *
 *
 * @method     ChildTickerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTickerQuery orderByExchangeName($order = Criteria::ASC) Order by the exchange_name column
 * @method     ChildTickerQuery orderBySymbol($order = Criteria::ASC) Order by the symbol column
 * @method     ChildTickerQuery orderByCurrencyBase($order = Criteria::ASC) Order by the currency_base column
 * @method     ChildTickerQuery orderByCurrencyQuote($order = Criteria::ASC) Order by the currency_quote column
 * @method     ChildTickerQuery orderByBid($order = Criteria::ASC) Order by the bid column
 * @method     ChildTickerQuery orderByAsk($order = Criteria::ASC) Order by the ask column
 * @method     ChildTickerQuery orderByLast($order = Criteria::ASC) Order by the last column
 * @method     ChildTickerQuery orderByOpen($order = Criteria::ASC) Order by the open column
 * @method     ChildTickerQuery orderByHigh($order = Criteria::ASC) Order by the high column
 * @method     ChildTickerQuery orderByLow($order = Criteria::ASC) Order by the low column
 * @method     ChildTickerQuery orderByVolume($order = Criteria::ASC) Order by the volume column
 * @method     ChildTickerQuery orderByFeeRateBuy($order = Criteria::ASC) Order by the fee_rate_buy column
 * @method     ChildTickerQuery orderByFeeRateSell($order = Criteria::ASC) Order by the fee_rate_sell column
 * @method     ChildTickerQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildTickerQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTickerQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildTickerQuery groupById() Group by the id column
 * @method     ChildTickerQuery groupByExchangeName() Group by the exchange_name column
 * @method     ChildTickerQuery groupBySymbol() Group by the symbol column
 * @method     ChildTickerQuery groupByCurrencyBase() Group by the currency_base column
 * @method     ChildTickerQuery groupByCurrencyQuote() Group by the currency_quote column
 * @method     ChildTickerQuery groupByBid() Group by the bid column
 * @method     ChildTickerQuery groupByAsk() Group by the ask column
 * @method     ChildTickerQuery groupByLast() Group by the last column
 * @method     ChildTickerQuery groupByOpen() Group by the open column
 * @method     ChildTickerQuery groupByHigh() Group by the high column
 * @method     ChildTickerQuery groupByLow() Group by the low column
 * @method     ChildTickerQuery groupByVolume() Group by the volume column
 * @method     ChildTickerQuery groupByFeeRateBuy() Group by the fee_rate_buy column
 * @method     ChildTickerQuery groupByFeeRateSell() Group by the fee_rate_sell column
 * @method     ChildTickerQuery groupByIsActive() Group by the is_active column
 * @method     ChildTickerQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTickerQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildTickerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTickerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTickerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTickerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTickerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTickerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTickerQuery leftJoinMatrixItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the MatrixItem relation
 * @method     ChildTickerQuery rightJoinMatrixItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MatrixItem relation
 * @method     ChildTickerQuery innerJoinMatrixItem($relationAlias = null) Adds a INNER JOIN clause to the query using the MatrixItem relation
 *
 * @method     ChildTickerQuery joinWithMatrixItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MatrixItem relation
 *
 * @method     ChildTickerQuery leftJoinWithMatrixItem() Adds a LEFT JOIN clause and with to the query using the MatrixItem relation
 * @method     ChildTickerQuery rightJoinWithMatrixItem() Adds a RIGHT JOIN clause and with to the query using the MatrixItem relation
 * @method     ChildTickerQuery innerJoinWithMatrixItem() Adds a INNER JOIN clause and with to the query using the MatrixItem relation
 *
 * @method     \MatrixItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTicker findOne(ConnectionInterface $con = null) Return the first ChildTicker matching the query
 * @method     ChildTicker findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTicker matching the query, or a new ChildTicker object populated from the query conditions when no match is found
 *
 * @method     ChildTicker findOneById(int $id) Return the first ChildTicker filtered by the id column
 * @method     ChildTicker findOneByExchangeName(string $exchange_name) Return the first ChildTicker filtered by the exchange_name column
 * @method     ChildTicker findOneBySymbol(string $symbol) Return the first ChildTicker filtered by the symbol column
 * @method     ChildTicker findOneByCurrencyBase(string $currency_base) Return the first ChildTicker filtered by the currency_base column
 * @method     ChildTicker findOneByCurrencyQuote(string $currency_quote) Return the first ChildTicker filtered by the currency_quote column
 * @method     ChildTicker findOneByBid(double $bid) Return the first ChildTicker filtered by the bid column
 * @method     ChildTicker findOneByAsk(double $ask) Return the first ChildTicker filtered by the ask column
 * @method     ChildTicker findOneByLast(double $last) Return the first ChildTicker filtered by the last column
 * @method     ChildTicker findOneByOpen(double $open) Return the first ChildTicker filtered by the open column
 * @method     ChildTicker findOneByHigh(double $high) Return the first ChildTicker filtered by the high column
 * @method     ChildTicker findOneByLow(double $low) Return the first ChildTicker filtered by the low column
 * @method     ChildTicker findOneByVolume(double $volume) Return the first ChildTicker filtered by the volume column
 * @method     ChildTicker findOneByFeeRateBuy(double $fee_rate_buy) Return the first ChildTicker filtered by the fee_rate_buy column
 * @method     ChildTicker findOneByFeeRateSell(double $fee_rate_sell) Return the first ChildTicker filtered by the fee_rate_sell column
 * @method     ChildTicker findOneByIsActive(boolean $is_active) Return the first ChildTicker filtered by the is_active column
 * @method     ChildTicker findOneByCreatedAt(string $created_at) Return the first ChildTicker filtered by the created_at column
 * @method     ChildTicker findOneByUpdatedAt(string $updated_at) Return the first ChildTicker filtered by the updated_at column *

 * @method     ChildTicker requirePk($key, ConnectionInterface $con = null) Return the ChildTicker by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOne(ConnectionInterface $con = null) Return the first ChildTicker matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTicker requireOneById(int $id) Return the first ChildTicker filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByExchangeName(string $exchange_name) Return the first ChildTicker filtered by the exchange_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneBySymbol(string $symbol) Return the first ChildTicker filtered by the symbol column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByCurrencyBase(string $currency_base) Return the first ChildTicker filtered by the currency_base column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByCurrencyQuote(string $currency_quote) Return the first ChildTicker filtered by the currency_quote column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByBid(double $bid) Return the first ChildTicker filtered by the bid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByAsk(double $ask) Return the first ChildTicker filtered by the ask column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByLast(double $last) Return the first ChildTicker filtered by the last column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByOpen(double $open) Return the first ChildTicker filtered by the open column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByHigh(double $high) Return the first ChildTicker filtered by the high column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByLow(double $low) Return the first ChildTicker filtered by the low column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByVolume(double $volume) Return the first ChildTicker filtered by the volume column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByFeeRateBuy(double $fee_rate_buy) Return the first ChildTicker filtered by the fee_rate_buy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByFeeRateSell(double $fee_rate_sell) Return the first ChildTicker filtered by the fee_rate_sell column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByIsActive(boolean $is_active) Return the first ChildTicker filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByCreatedAt(string $created_at) Return the first ChildTicker filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicker requireOneByUpdatedAt(string $updated_at) Return the first ChildTicker filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTicker[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTicker objects based on current ModelCriteria
 * @method     ChildTicker[]|ObjectCollection findById(int $id) Return ChildTicker objects filtered by the id column
 * @method     ChildTicker[]|ObjectCollection findByExchangeName(string $exchange_name) Return ChildTicker objects filtered by the exchange_name column
 * @method     ChildTicker[]|ObjectCollection findBySymbol(string $symbol) Return ChildTicker objects filtered by the symbol column
 * @method     ChildTicker[]|ObjectCollection findByCurrencyBase(string $currency_base) Return ChildTicker objects filtered by the currency_base column
 * @method     ChildTicker[]|ObjectCollection findByCurrencyQuote(string $currency_quote) Return ChildTicker objects filtered by the currency_quote column
 * @method     ChildTicker[]|ObjectCollection findByBid(double $bid) Return ChildTicker objects filtered by the bid column
 * @method     ChildTicker[]|ObjectCollection findByAsk(double $ask) Return ChildTicker objects filtered by the ask column
 * @method     ChildTicker[]|ObjectCollection findByLast(double $last) Return ChildTicker objects filtered by the last column
 * @method     ChildTicker[]|ObjectCollection findByOpen(double $open) Return ChildTicker objects filtered by the open column
 * @method     ChildTicker[]|ObjectCollection findByHigh(double $high) Return ChildTicker objects filtered by the high column
 * @method     ChildTicker[]|ObjectCollection findByLow(double $low) Return ChildTicker objects filtered by the low column
 * @method     ChildTicker[]|ObjectCollection findByVolume(double $volume) Return ChildTicker objects filtered by the volume column
 * @method     ChildTicker[]|ObjectCollection findByFeeRateBuy(double $fee_rate_buy) Return ChildTicker objects filtered by the fee_rate_buy column
 * @method     ChildTicker[]|ObjectCollection findByFeeRateSell(double $fee_rate_sell) Return ChildTicker objects filtered by the fee_rate_sell column
 * @method     ChildTicker[]|ObjectCollection findByIsActive(boolean $is_active) Return ChildTicker objects filtered by the is_active column
 * @method     ChildTicker[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildTicker objects filtered by the created_at column
 * @method     ChildTicker[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildTicker objects filtered by the updated_at column
 * @method     ChildTicker[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TickerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TickerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'analizoexchangeapitester', $modelName = '\\Ticker', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTickerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTickerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTickerQuery) {
            return $criteria;
        }
        $query = new ChildTickerQuery();
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
     * @return ChildTicker|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TickerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TickerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTicker A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `exchange_name`, `symbol`, `currency_base`, `currency_quote`, `bid`, `ask`, `last`, `open`, `high`, `low`, `volume`, `fee_rate_buy`, `fee_rate_sell`, `is_active`, `created_at`, `updated_at` FROM `ticker` WHERE `id` = :p0';
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
            /** @var ChildTicker $obj */
            $obj = new ChildTicker();
            $obj->hydrate($row);
            TickerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTicker|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TickerTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TickerTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the exchange_name column
     *
     * Example usage:
     * <code>
     * $query->filterByExchangeName('fooValue');   // WHERE exchange_name = 'fooValue'
     * $query->filterByExchangeName('%fooValue%', Criteria::LIKE); // WHERE exchange_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $exchangeName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByExchangeName($exchangeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($exchangeName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_EXCHANGE_NAME, $exchangeName, $comparison);
    }

    /**
     * Filter the query on the symbol column
     *
     * Example usage:
     * <code>
     * $query->filterBySymbol('fooValue');   // WHERE symbol = 'fooValue'
     * $query->filterBySymbol('%fooValue%', Criteria::LIKE); // WHERE symbol LIKE '%fooValue%'
     * </code>
     *
     * @param     string $symbol The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterBySymbol($symbol = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($symbol)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_SYMBOL, $symbol, $comparison);
    }

    /**
     * Filter the query on the currency_base column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyBase('fooValue');   // WHERE currency_base = 'fooValue'
     * $query->filterByCurrencyBase('%fooValue%', Criteria::LIKE); // WHERE currency_base LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currencyBase The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByCurrencyBase($currencyBase = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currencyBase)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_CURRENCY_BASE, $currencyBase, $comparison);
    }

    /**
     * Filter the query on the currency_quote column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyQuote('fooValue');   // WHERE currency_quote = 'fooValue'
     * $query->filterByCurrencyQuote('%fooValue%', Criteria::LIKE); // WHERE currency_quote LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currencyQuote The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByCurrencyQuote($currencyQuote = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currencyQuote)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_CURRENCY_QUOTE, $currencyQuote, $comparison);
    }

    /**
     * Filter the query on the bid column
     *
     * Example usage:
     * <code>
     * $query->filterByBid(1234); // WHERE bid = 1234
     * $query->filterByBid(array(12, 34)); // WHERE bid IN (12, 34)
     * $query->filterByBid(array('min' => 12)); // WHERE bid > 12
     * </code>
     *
     * @param     mixed $bid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByBid($bid = null, $comparison = null)
    {
        if (is_array($bid)) {
            $useMinMax = false;
            if (isset($bid['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_BID, $bid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bid['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_BID, $bid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_BID, $bid, $comparison);
    }

    /**
     * Filter the query on the ask column
     *
     * Example usage:
     * <code>
     * $query->filterByAsk(1234); // WHERE ask = 1234
     * $query->filterByAsk(array(12, 34)); // WHERE ask IN (12, 34)
     * $query->filterByAsk(array('min' => 12)); // WHERE ask > 12
     * </code>
     *
     * @param     mixed $ask The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByAsk($ask = null, $comparison = null)
    {
        if (is_array($ask)) {
            $useMinMax = false;
            if (isset($ask['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_ASK, $ask['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ask['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_ASK, $ask['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_ASK, $ask, $comparison);
    }

    /**
     * Filter the query on the last column
     *
     * Example usage:
     * <code>
     * $query->filterByLast(1234); // WHERE last = 1234
     * $query->filterByLast(array(12, 34)); // WHERE last IN (12, 34)
     * $query->filterByLast(array('min' => 12)); // WHERE last > 12
     * </code>
     *
     * @param     mixed $last The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByLast($last = null, $comparison = null)
    {
        if (is_array($last)) {
            $useMinMax = false;
            if (isset($last['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_LAST, $last['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($last['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_LAST, $last['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_LAST, $last, $comparison);
    }

    /**
     * Filter the query on the open column
     *
     * Example usage:
     * <code>
     * $query->filterByOpen(1234); // WHERE open = 1234
     * $query->filterByOpen(array(12, 34)); // WHERE open IN (12, 34)
     * $query->filterByOpen(array('min' => 12)); // WHERE open > 12
     * </code>
     *
     * @param     mixed $open The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByOpen($open = null, $comparison = null)
    {
        if (is_array($open)) {
            $useMinMax = false;
            if (isset($open['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_OPEN, $open['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($open['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_OPEN, $open['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_OPEN, $open, $comparison);
    }

    /**
     * Filter the query on the high column
     *
     * Example usage:
     * <code>
     * $query->filterByHigh(1234); // WHERE high = 1234
     * $query->filterByHigh(array(12, 34)); // WHERE high IN (12, 34)
     * $query->filterByHigh(array('min' => 12)); // WHERE high > 12
     * </code>
     *
     * @param     mixed $high The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByHigh($high = null, $comparison = null)
    {
        if (is_array($high)) {
            $useMinMax = false;
            if (isset($high['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_HIGH, $high['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($high['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_HIGH, $high['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_HIGH, $high, $comparison);
    }

    /**
     * Filter the query on the low column
     *
     * Example usage:
     * <code>
     * $query->filterByLow(1234); // WHERE low = 1234
     * $query->filterByLow(array(12, 34)); // WHERE low IN (12, 34)
     * $query->filterByLow(array('min' => 12)); // WHERE low > 12
     * </code>
     *
     * @param     mixed $low The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByLow($low = null, $comparison = null)
    {
        if (is_array($low)) {
            $useMinMax = false;
            if (isset($low['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_LOW, $low['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($low['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_LOW, $low['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_LOW, $low, $comparison);
    }

    /**
     * Filter the query on the volume column
     *
     * Example usage:
     * <code>
     * $query->filterByVolume(1234); // WHERE volume = 1234
     * $query->filterByVolume(array(12, 34)); // WHERE volume IN (12, 34)
     * $query->filterByVolume(array('min' => 12)); // WHERE volume > 12
     * </code>
     *
     * @param     mixed $volume The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByVolume($volume = null, $comparison = null)
    {
        if (is_array($volume)) {
            $useMinMax = false;
            if (isset($volume['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_VOLUME, $volume['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($volume['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_VOLUME, $volume['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_VOLUME, $volume, $comparison);
    }

    /**
     * Filter the query on the fee_rate_buy column
     *
     * Example usage:
     * <code>
     * $query->filterByFeeRateBuy(1234); // WHERE fee_rate_buy = 1234
     * $query->filterByFeeRateBuy(array(12, 34)); // WHERE fee_rate_buy IN (12, 34)
     * $query->filterByFeeRateBuy(array('min' => 12)); // WHERE fee_rate_buy > 12
     * </code>
     *
     * @param     mixed $feeRateBuy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByFeeRateBuy($feeRateBuy = null, $comparison = null)
    {
        if (is_array($feeRateBuy)) {
            $useMinMax = false;
            if (isset($feeRateBuy['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_FEE_RATE_BUY, $feeRateBuy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($feeRateBuy['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_FEE_RATE_BUY, $feeRateBuy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_FEE_RATE_BUY, $feeRateBuy, $comparison);
    }

    /**
     * Filter the query on the fee_rate_sell column
     *
     * Example usage:
     * <code>
     * $query->filterByFeeRateSell(1234); // WHERE fee_rate_sell = 1234
     * $query->filterByFeeRateSell(array(12, 34)); // WHERE fee_rate_sell IN (12, 34)
     * $query->filterByFeeRateSell(array('min' => 12)); // WHERE fee_rate_sell > 12
     * </code>
     *
     * @param     mixed $feeRateSell The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByFeeRateSell($feeRateSell = null, $comparison = null)
    {
        if (is_array($feeRateSell)) {
            $useMinMax = false;
            if (isset($feeRateSell['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_FEE_RATE_SELL, $feeRateSell['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($feeRateSell['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_FEE_RATE_SELL, $feeRateSell['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_FEE_RATE_SELL, $feeRateSell, $comparison);
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(true); // WHERE is_active = true
     * $query->filterByIsActive('yes'); // WHERE is_active = true
     * </code>
     *
     * @param     boolean|string $isActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TickerTableMap::COL_IS_ACTIVE, $isActive, $comparison);
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
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TickerTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TickerTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TickerTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \MatrixItem object
     *
     * @param \MatrixItem|ObjectCollection $matrixItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTickerQuery The current query, for fluid interface
     */
    public function filterByMatrixItem($matrixItem, $comparison = null)
    {
        if ($matrixItem instanceof \MatrixItem) {
            return $this
                ->addUsingAlias(TickerTableMap::COL_ID, $matrixItem->getIdTicker(), $comparison);
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
     * @return $this|ChildTickerQuery The current query, for fluid interface
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
     * @param   ChildTicker $ticker Object to remove from the list of results
     *
     * @return $this|ChildTickerQuery The current query, for fluid interface
     */
    public function prune($ticker = null)
    {
        if ($ticker) {
            $this->addUsingAlias(TickerTableMap::COL_ID, $ticker->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ticker table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TickerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TickerTableMap::clearInstancePool();
            TickerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TickerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TickerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TickerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TickerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildTickerQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TickerTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildTickerQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TickerTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildTickerQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TickerTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildTickerQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TickerTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildTickerQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TickerTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildTickerQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TickerTableMap::COL_CREATED_AT);
    }

} // TickerQuery
