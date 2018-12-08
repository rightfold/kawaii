<?php
declare(strict_types = 1);
namespace Kawaii\Ticket\Facts;

use Kawaii\Database;
use Kawaii\Ticket\Facts\View\Model;

/**
 * Implementation of the use case <em>View ticket facts</em>.
 */
final class View {
    /** @var Database\Connection */
    public $database;

    public function __construct(Database\Connection $database) {
        $this->database = $database;
    }

    public function viewTicketFacts(string $ticketId): ?Model {
        $result = $this->database->query('
            SELECT title, facts
            FROM kawaii.tickets
            WHERE id = $1
        ', [$ticketId]);
        foreach ($result as list($title, $facts)) {
            assert($title !== NULL);
            assert($facts !== NULL);
            return new Model($title, $facts);
        }
        return NULL;
    }
}
