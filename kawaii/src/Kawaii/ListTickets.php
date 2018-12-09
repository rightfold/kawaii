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
    private $database;

    public function __construct(Database\Connection $database) {
        $this->database = $database;
    }

    /**
     * @return iterable<int,Model>
     */
    public function listTickets(): iterable {
        $tickets = $this->database->query('
            SELECT
                sub.id,
                sub.title
            FROM (
                SELECT
                    tickets.id,
                    ticket_revisions.title,
                    rank() OVER most_recent
                FROM kawaii.tickets
                JOIN kawaii.ticket_revisions
                    ON ticket_revisions.ticket_id = tickets.id
                WINDOW most_recent AS (
                    PARTITION BY tickets.id
                    ORDER BY ticket_revisions.revision DESC
                )
            ) AS sub
            WHERE sub.rank = 1
        ', []);
        foreach ($tickets as list($ticketId, $ticketTitle)) {
            assert($ticketId !== NULL);
            assert($ticketTitle !== NULL);
            yield new Model($ticketId, $ticketTitle);
        }
    }
}
