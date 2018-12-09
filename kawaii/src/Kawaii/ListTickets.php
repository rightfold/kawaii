<?php
declare(strict_types = 1);
namespace Kawaii;

use Kawaii\Database;
use Kawaii\ListTickets\Model;

/**
 * Implementation of the use case <em>List tickets</em>.
 */
final class ListTickets {
    /** @var Database\Connection */
    public $database;

    public function __construct(Database\Connection $database) {
        $this->database = $database;
    }

    /**
     * @return iterable<int,Model>
     */
    public function listTickets(): iterable {
        $tickets = $this->database->query('
            SELECT id, title
            FROM kawaii.tickets
        ', []);
        foreach ($tickets as list($ticketId, $ticketTitle)) {
            assert($ticketId !== NULL);
            assert($ticketTitle !== NULL);
            yield new Model($ticketId, $ticketTitle);
        }
    }
}
