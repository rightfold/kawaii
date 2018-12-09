<?php
declare(strict_types = 1);
namespace Kawaii\Database;

use Throwable;

/**
 * Thin wrapper around pgsql with types.
 */
final class Connection {
    public const READ_COMMITTED = 'READ COMMITTED';

    public const READ_WRITE = 'READ WRITE';

    public const SQLSTATE_CHECK_VIOLATION = '23514';

    /** @var resource */
    public $raw;

    public function __construct(string $connstr) {
        $this->raw = \pg_connect($connstr);
    }

    /**
     * Call the given function in a transaction.
     *
     * @template T
     * @param callable():T $thunk
     * @return T
     */
    public function inTransaction(string $isolationLevel, string $mode, callable $thunk) {
        assert($isolationLevel === self::READ_COMMITTED);
        assert($mode === self::READ_WRITE);
        $this->execute("
            START TRANSACTION
                ISOLATION LEVEL $isolationLevel
                $mode
        ", []);
        try {
            $result = $thunk();
        } catch (Throwable $ex) {
            $this->execute('ROLLBACK WORK', []);
            throw $ex;
        }
        $this->execute('COMMIT WORK', []);
        return $result;
    }

    /**
     * Query the database, ignoring rows.
     *
     * @param (?string)[] $arguments
     */
    public function execute(string $statement, array $arguments): void {
        $this->internal($statement, $arguments);
    }

    /**
     * Query the database, yielding rows.
     *
     * @param (?string)[] $arguments
     * @return iterable<int,(?string)[]>
     */
    public function query(string $statement, array $arguments): iterable {
        $result = $this->internal($statement, $arguments);
        for (;;) {
            /** @var false|(?string)[] */
            $row = \pg_fetch_row($result);
            if ($row === FALSE) {
                break;
            }
            yield $row;
        }
    }

    /**
     * @param (?string)[] $arguments
     * @return resource
     */
    private function internal(string $statement, array $arguments) {
        $ok = \pg_send_query_params($this->raw, $statement, $arguments);
        if (!$ok) {
            // TODO: Throw a reasonable exception.
            die();
        }

        $result = \pg_get_result($this->raw);
        /** @var int */
        $status = \pg_result_status($result);
        switch ($status) {
        case \PGSQL_EMPTY_QUERY:
        case \PGSQL_COMMAND_OK:
        case \PGSQL_TUPLES_OK:
            return $result;

        case \PGSQL_COPY_OUT:
        case \PGSQL_COPY_IN:
            // TODO: Throw a reasonable exception.
            die();

        case \PGSQL_BAD_RESPONSE:
        case \PGSQL_NONFATAL_ERROR:
            // TODO: Throw a reasonable exception.
            die();

        case \PGSQL_FATAL_ERROR:
            throw $this->errorToException($result);

        default:
            // TODO: Throw a reasonable exception.
            die();
        }
    }

    /** @param resource $result */
    private function errorToException($result): Throwable {
        $message = \pg_result_error($result);
        $sqlstate = \pg_result_error_field($result, \PGSQL_DIAG_SQLSTATE);
        // TODO: After upgrading to PHP 7.3, use the defined constant
        // TODO: \PGSQL_DIAG_CONSTRAINT_NAME which is not yet available.
        $constraintName = \pg_result_error_field($result, \ord('n'));

        switch ($sqlstate) {
        case self::SQLSTATE_CHECK_VIOLATION:
            return new CheckConstraintViolationException($message, $constraintName);
        }

        return new DatabaseException($message);
    }
}
