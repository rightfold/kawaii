<?php
declare(strict_types = 1);
namespace Kawaii\Database;

/**
 * Thin wrapper around pgsql with types.
 */
final class Connection {
    /** @var resource */
    public $raw;

    public function __construct(string $connstr) {
        $this->raw = \pg_connect($connstr);
    }

    /**
     * Query the database, yielding rows.
     *
     * @param (?string)[] $arguments
     * @return iterable<int,(?string)[]>
     */
    public function query(string $statement, array $arguments): iterable {
        $result = \pg_query_params($this->raw, $statement, $arguments);
        for (;;) {
            /** @var false|(?string)[] */
            $row = \pg_fetch_row($result);
            if ($row === FALSE) {
                break;
            }
            yield $row;
        }
    }
}
