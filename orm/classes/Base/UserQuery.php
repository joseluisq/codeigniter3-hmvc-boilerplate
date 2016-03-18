<?php

namespace Base;

use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \Exception;
use \PDO;
use Map\UserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user' table.
 *
 *
 *
 * @method     ChildUserQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserQuery orderByUserFullname($order = Criteria::ASC) Order by the user_fullname column
 * @method     ChildUserQuery orderByUserEmail($order = Criteria::ASC) Order by the user_email column
 * @method     ChildUserQuery orderByUserPassword($order = Criteria::ASC) Order by the user_password column
 * @method     ChildUserQuery orderByUserDni($order = Criteria::ASC) Order by the user_dni column
 * @method     ChildUserQuery orderByUserPhone($order = Criteria::ASC) Order by the user_phone column
 * @method     ChildUserQuery orderByUserRegistered($order = Criteria::ASC) Order by the user_registered column
 * @method     ChildUserQuery orderByUserUpdated($order = Criteria::ASC) Order by the user_updated column
 * @method     ChildUserQuery orderByUserState($order = Criteria::ASC) Order by the user_state column
 *
 * @method     ChildUserQuery groupByUserId() Group by the user_id column
 * @method     ChildUserQuery groupByUserFullname() Group by the user_fullname column
 * @method     ChildUserQuery groupByUserEmail() Group by the user_email column
 * @method     ChildUserQuery groupByUserPassword() Group by the user_password column
 * @method     ChildUserQuery groupByUserDni() Group by the user_dni column
 * @method     ChildUserQuery groupByUserPhone() Group by the user_phone column
 * @method     ChildUserQuery groupByUserRegistered() Group by the user_registered column
 * @method     ChildUserQuery groupByUserUpdated() Group by the user_updated column
 * @method     ChildUserQuery groupByUserState() Group by the user_state column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneByUserId(int $user_id) Return the first ChildUser filtered by the user_id column
 * @method     ChildUser findOneByUserFullname(string $user_fullname) Return the first ChildUser filtered by the user_fullname column
 * @method     ChildUser findOneByUserEmail(string $user_email) Return the first ChildUser filtered by the user_email column
 * @method     ChildUser findOneByUserPassword(string $user_password) Return the first ChildUser filtered by the user_password column
 * @method     ChildUser findOneByUserDni(string $user_dni) Return the first ChildUser filtered by the user_dni column
 * @method     ChildUser findOneByUserPhone(string $user_phone) Return the first ChildUser filtered by the user_phone column
 * @method     ChildUser findOneByUserRegistered(string $user_registered) Return the first ChildUser filtered by the user_registered column
 * @method     ChildUser findOneByUserUpdated(string $user_updated) Return the first ChildUser filtered by the user_updated column
 * @method     ChildUser findOneByUserState(int $user_state) Return the first ChildUser filtered by the user_state column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneByUserId(int $user_id) Return the first ChildUser filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserFullname(string $user_fullname) Return the first ChildUser filtered by the user_fullname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserEmail(string $user_email) Return the first ChildUser filtered by the user_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserPassword(string $user_password) Return the first ChildUser filtered by the user_password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserDni(string $user_dni) Return the first ChildUser filtered by the user_dni column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserPhone(string $user_phone) Return the first ChildUser filtered by the user_phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserRegistered(string $user_registered) Return the first ChildUser filtered by the user_registered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserUpdated(string $user_updated) Return the first ChildUser filtered by the user_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserState(int $user_state) Return the first ChildUser filtered by the user_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findByUserId(int $user_id) Return ChildUser objects filtered by the user_id column
 * @method     ChildUser[]|ObjectCollection findByUserFullname(string $user_fullname) Return ChildUser objects filtered by the user_fullname column
 * @method     ChildUser[]|ObjectCollection findByUserEmail(string $user_email) Return ChildUser objects filtered by the user_email column
 * @method     ChildUser[]|ObjectCollection findByUserPassword(string $user_password) Return ChildUser objects filtered by the user_password column
 * @method     ChildUser[]|ObjectCollection findByUserDni(string $user_dni) Return ChildUser objects filtered by the user_dni column
 * @method     ChildUser[]|ObjectCollection findByUserPhone(string $user_phone) Return ChildUser objects filtered by the user_phone column
 * @method     ChildUser[]|ObjectCollection findByUserRegistered(string $user_registered) Return ChildUser objects filtered by the user_registered column
 * @method     ChildUser[]|ObjectCollection findByUserUpdated(string $user_updated) Return ChildUser objects filtered by the user_updated column
 * @method     ChildUser[]|ObjectCollection findByUserState(int $user_state) Return ChildUser objects filtered by the user_state column
 * @method     ChildUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'development', $modelName = '\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserQuery) {
            return $criteria;
        }
        $query = new ChildUserQuery();
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
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
     * @return ChildUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_id, user_fullname, user_email, user_password, user_dni, user_phone, user_registered, user_updated, user_state FROM user WHERE user_id = :p0';
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
            /** @var ChildUser $obj */
            $obj = new ChildUser();
            $obj->hydrate($row);
            UserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserTableMap::COL_USER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserTableMap::COL_USER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the user_fullname column
     *
     * Example usage:
     * <code>
     * $query->filterByUserFullname('fooValue');   // WHERE user_fullname = 'fooValue'
     * $query->filterByUserFullname('%fooValue%'); // WHERE user_fullname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userFullname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserFullname($userFullname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userFullname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userFullname)) {
                $userFullname = str_replace('*', '%', $userFullname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_FULLNAME, $userFullname, $comparison);
    }

    /**
     * Filter the query on the user_email column
     *
     * Example usage:
     * <code>
     * $query->filterByUserEmail('fooValue');   // WHERE user_email = 'fooValue'
     * $query->filterByUserEmail('%fooValue%'); // WHERE user_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserEmail($userEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userEmail)) {
                $userEmail = str_replace('*', '%', $userEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_EMAIL, $userEmail, $comparison);
    }

    /**
     * Filter the query on the user_password column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPassword('fooValue');   // WHERE user_password = 'fooValue'
     * $query->filterByUserPassword('%fooValue%'); // WHERE user_password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userPassword The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserPassword($userPassword = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userPassword)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userPassword)) {
                $userPassword = str_replace('*', '%', $userPassword);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_PASSWORD, $userPassword, $comparison);
    }

    /**
     * Filter the query on the user_dni column
     *
     * Example usage:
     * <code>
     * $query->filterByUserDni('fooValue');   // WHERE user_dni = 'fooValue'
     * $query->filterByUserDni('%fooValue%'); // WHERE user_dni LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userDni The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserDni($userDni = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userDni)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userDni)) {
                $userDni = str_replace('*', '%', $userDni);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_DNI, $userDni, $comparison);
    }

    /**
     * Filter the query on the user_phone column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPhone('fooValue');   // WHERE user_phone = 'fooValue'
     * $query->filterByUserPhone('%fooValue%'); // WHERE user_phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userPhone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserPhone($userPhone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userPhone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userPhone)) {
                $userPhone = str_replace('*', '%', $userPhone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_PHONE, $userPhone, $comparison);
    }

    /**
     * Filter the query on the user_registered column
     *
     * Example usage:
     * <code>
     * $query->filterByUserRegistered('2011-03-14'); // WHERE user_registered = '2011-03-14'
     * $query->filterByUserRegistered('now'); // WHERE user_registered = '2011-03-14'
     * $query->filterByUserRegistered(array('max' => 'yesterday')); // WHERE user_registered > '2011-03-13'
     * </code>
     *
     * @param     mixed $userRegistered The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserRegistered($userRegistered = null, $comparison = null)
    {
        if (is_array($userRegistered)) {
            $useMinMax = false;
            if (isset($userRegistered['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_REGISTERED, $userRegistered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userRegistered['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_REGISTERED, $userRegistered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_REGISTERED, $userRegistered, $comparison);
    }

    /**
     * Filter the query on the user_updated column
     *
     * Example usage:
     * <code>
     * $query->filterByUserUpdated('2011-03-14'); // WHERE user_updated = '2011-03-14'
     * $query->filterByUserUpdated('now'); // WHERE user_updated = '2011-03-14'
     * $query->filterByUserUpdated(array('max' => 'yesterday')); // WHERE user_updated > '2011-03-13'
     * </code>
     *
     * @param     mixed $userUpdated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserUpdated($userUpdated = null, $comparison = null)
    {
        if (is_array($userUpdated)) {
            $useMinMax = false;
            if (isset($userUpdated['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_UPDATED, $userUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userUpdated['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_UPDATED, $userUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_UPDATED, $userUpdated, $comparison);
    }

    /**
     * Filter the query on the user_state column
     *
     * Example usage:
     * <code>
     * $query->filterByUserState(1234); // WHERE user_state = 1234
     * $query->filterByUserState(array(12, 34)); // WHERE user_state IN (12, 34)
     * $query->filterByUserState(array('min' => 12)); // WHERE user_state > 12
     * </code>
     *
     * @param     mixed $userState The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserState($userState = null, $comparison = null)
    {
        if (is_array($userState)) {
            $useMinMax = false;
            if (isset($userState['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_STATE, $userState['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userState['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_STATE, $userState['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_STATE, $userState, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUser $user Object to remove from the list of results
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserTableMap::COL_USER_ID, $user->getUserId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserTableMap::clearInstancePool();
            UserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserQuery
