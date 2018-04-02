<?php

namespace Base;

use \WalletVersion as ChildWalletVersion;
use \WalletVersionQuery as ChildWalletVersionQuery;
use \Exception;
use \PDO;
use Map\WalletVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wallet_version' table.
 *
 *
 *
 * @method     ChildWalletVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWalletVersionQuery orderByExchangeName($order = Criteria::ASC) Order by the exchange_name column
 * @method     ChildWalletVersionQuery orderByCurrency($order = Criteria::ASC) Order by the currency column
 * @method     ChildWalletVersionQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildWalletVersionQuery orderByFee($order = Criteria::ASC) Order by the fee column
 * @method     ChildWalletVersionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWalletVersionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildWalletVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildWalletVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 *
 * @method     ChildWalletVersionQuery groupById() Group by the id column
 * @method     ChildWalletVersionQuery groupByExchangeName() Group by the exchange_name column
 * @method     ChildWalletVersionQuery groupByCurrency() Group by the currency column
 * @method     ChildWalletVersionQuery groupByActive() Group by the active column
 * @method     ChildWalletVersionQuery groupByFee() Group by the fee column
 * @method     ChildWalletVersionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWalletVersionQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildWalletVersionQuery groupByVersion() Group by the version column
 * @method     ChildWalletVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 *
 * @method     ChildWalletVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWalletVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWalletVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWalletVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWalletVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWalletVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWalletVersionQuery leftJoinWallet($relationAlias = null) Adds a LEFT JOIN clause to the query using the Wallet relation
 * @method     ChildWalletVersionQuery rightJoinWallet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Wallet relation
 * @method     ChildWalletVersionQuery innerJoinWallet($relationAlias = null) Adds a INNER JOIN clause to the query using the Wallet relation
 *
 * @method     ChildWalletVersionQuery joinWithWallet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Wallet relation
 *
 * @method     ChildWalletVersionQuery leftJoinWithWallet() Adds a LEFT JOIN clause and with to the query using the Wallet relation
 * @method     ChildWalletVersionQuery rightJoinWithWallet() Adds a RIGHT JOIN clause and with to the query using the Wallet relation
 * @method     ChildWalletVersionQuery innerJoinWithWallet() Adds a INNER JOIN clause and with to the query using the Wallet relation
 *
 * @method     \WalletQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWalletVersion findOne(ConnectionInterface $con = null) Return the first ChildWalletVersion matching the query
 * @method     ChildWalletVersion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWalletVersion matching the query, or a new ChildWalletVersion object populated from the query conditions when no match is found
 *
 * @method     ChildWalletVersion findOneById(int $id) Return the first ChildWalletVersion filtered by the id column
 * @method     ChildWalletVersion findOneByExchangeName(string $exchange_name) Return the first ChildWalletVersion filtered by the exchange_name column
 * @method     ChildWalletVersion findOneByCurrency(string $currency) Return the first ChildWalletVersion filtered by the currency column
 * @method     ChildWalletVersion findOneByActive(boolean $active) Return the first ChildWalletVersion filtered by the active column
 * @method     ChildWalletVersion findOneByFee(double $fee) Return the first ChildWalletVersion filtered by the fee column
 * @method     ChildWalletVersion findOneByCreatedAt(string $created_at) Return the first ChildWalletVersion filtered by the created_at column
 * @method     ChildWalletVersion findOneByUpdatedAt(string $updated_at) Return the first ChildWalletVersion filtered by the updated_at column
 * @method     ChildWalletVersion findOneByVersion(int $version) Return the first ChildWalletVersion filtered by the version column
 * @method     ChildWalletVersion findOneByVersionCreatedAt(string $version_created_at) Return the first ChildWalletVersion filtered by the version_created_at column *

 * @method     ChildWalletVersion requirePk($key, ConnectionInterface $con = null) Return the ChildWalletVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalletVersion requireOne(ConnectionInterface $con = null) Return the first ChildWalletVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWalletVersion requireOneById(int $id) Return the first ChildWalletVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalletVersion requireOneByExchangeName(string $exchange_name) Return the first ChildWalletVersion filtered by the exchange_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalletVersion requireOneByCurrency(string $currency) Return the first ChildWalletVersion filtered by the currency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalletVersion requireOneByActive(boolean $active) Return the first ChildWalletVersion filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalletVersion requireOneByFee(double $fee) Return the first ChildWalletVersion filtered by the fee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalletVersion requireOneByCreatedAt(string $created_at) Return the first ChildWalletVersion filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalletVersion requireOneByUpdatedAt(string $updated_at) Return the first ChildWalletVersion filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalletVersion requireOneByVersion(int $version) Return the first ChildWalletVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalletVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildWalletVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWalletVersion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWalletVersion objects based on current ModelCriteria
 * @method     ChildWalletVersion[]|ObjectCollection findById(int $id) Return ChildWalletVersion objects filtered by the id column
 * @method     ChildWalletVersion[]|ObjectCollection findByExchangeName(string $exchange_name) Return ChildWalletVersion objects filtered by the exchange_name column
 * @method     ChildWalletVersion[]|ObjectCollection findByCurrency(string $currency) Return ChildWalletVersion objects filtered by the currency column
 * @method     ChildWalletVersion[]|ObjectCollection findByActive(boolean $active) Return ChildWalletVersion objects filtered by the active column
 * @method     ChildWalletVersion[]|ObjectCollection findByFee(double $fee) Return ChildWalletVersion objects filtered by the fee column
 * @method     ChildWalletVersion[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildWalletVersion objects filtered by the created_at column
 * @method     ChildWalletVersion[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildWalletVersion objects filtered by the updated_at column
 * @method     ChildWalletVersion[]|ObjectCollection findByVersion(int $version) Return ChildWalletVersion objects filtered by the version column
 * @method     ChildWalletVersion[]|ObjectCollection findByVersionCreatedAt(string $version_created_at) Return ChildWalletVersion objects filtered by the version_created_at column
 * @method     ChildWalletVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WalletVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WalletVersionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'analizoexchangeapitester', $modelName = '\\WalletVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWalletVersionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWalletVersionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWalletVersionQuery) {
            return $criteria;
        }
        $query = new ChildWalletVersionQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $version] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWalletVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WalletVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WalletVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildWalletVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `exchange_name`, `currency`, `active`, `fee`, `created_at`, `updated_at`, `version`, `version_created_at` FROM `wallet_version` WHERE `id` = :p0 AND `version` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWalletVersion $obj */
            $obj = new ChildWalletVersion();
            $obj->hydrate($row);
            WalletVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildWalletVersion|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(WalletVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(WalletVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(WalletVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(WalletVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByWallet()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalletVersionTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByExchangeName($exchangeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($exchangeName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalletVersionTableMap::COL_EXCHANGE_NAME, $exchangeName, $comparison);
    }

    /**
     * Filter the query on the currency column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrency('fooValue');   // WHERE currency = 'fooValue'
     * $query->filterByCurrency('%fooValue%', Criteria::LIKE); // WHERE currency LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currency The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByCurrency($currency = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currency)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalletVersionTableMap::COL_CURRENCY, $currency, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WalletVersionTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the fee column
     *
     * Example usage:
     * <code>
     * $query->filterByFee(1234); // WHERE fee = 1234
     * $query->filterByFee(array(12, 34)); // WHERE fee IN (12, 34)
     * $query->filterByFee(array('min' => 12)); // WHERE fee > 12
     * </code>
     *
     * @param     mixed $fee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByFee($fee = null, $comparison = null)
    {
        if (is_array($fee)) {
            $useMinMax = false;
            if (isset($fee['min'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_FEE, $fee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fee['max'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_FEE, $fee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalletVersionTableMap::COL_FEE, $fee, $comparison);
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
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalletVersionTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalletVersionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion(1234); // WHERE version = 1234
     * $query->filterByVersion(array(12, 34)); // WHERE version IN (12, 34)
     * $query->filterByVersion(array('min' => 12)); // WHERE version > 12
     * </code>
     *
     * @param     mixed $version The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalletVersionTableMap::COL_VERSION, $version, $comparison);
    }

    /**
     * Filter the query on the version_created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedAt('2011-03-14'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt('now'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt(array('max' => 'yesterday')); // WHERE version_created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $versionCreatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByVersionCreatedAt($versionCreatedAt = null, $comparison = null)
    {
        if (is_array($versionCreatedAt)) {
            $useMinMax = false;
            if (isset($versionCreatedAt['min'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(WalletVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalletVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Wallet object
     *
     * @param \Wallet|ObjectCollection $wallet The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWalletVersionQuery The current query, for fluid interface
     */
    public function filterByWallet($wallet, $comparison = null)
    {
        if ($wallet instanceof \Wallet) {
            return $this
                ->addUsingAlias(WalletVersionTableMap::COL_ID, $wallet->getId(), $comparison);
        } elseif ($wallet instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WalletVersionTableMap::COL_ID, $wallet->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByWallet() only accepts arguments of type \Wallet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Wallet relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function joinWallet($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Wallet');

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
            $this->addJoinObject($join, 'Wallet');
        }

        return $this;
    }

    /**
     * Use the Wallet relation Wallet object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WalletQuery A secondary query class using the current class as primary query
     */
    public function useWalletQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWallet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Wallet', '\WalletQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWalletVersion $walletVersion Object to remove from the list of results
     *
     * @return $this|ChildWalletVersionQuery The current query, for fluid interface
     */
    public function prune($walletVersion = null)
    {
        if ($walletVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(WalletVersionTableMap::COL_ID), $walletVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(WalletVersionTableMap::COL_VERSION), $walletVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wallet_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WalletVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WalletVersionTableMap::clearInstancePool();
            WalletVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WalletVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WalletVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WalletVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WalletVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WalletVersionQuery
