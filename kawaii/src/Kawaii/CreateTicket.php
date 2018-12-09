<?php
declare(strict_types = 1);
namespace Kawaii;

use Kawaii\Database;
use Kawaii\CreateTicket\Model;
use Kawaii\Utility\Uuid;

/**
 * Implementation of the use case <em>Create ticket</em>.
 */
final class CreateTicket {
    /** @var Database\Connection */
    private $database;

    public function __construct(Database\Connection $database) {
        $this->database = $database;
    }

    public function createTicket(string $ticketTitle, string $ticketFacts): Model {
        $ticketId = Uuid::generateV4();
        $this->database->execute('
            INSERT INTO kawaii.tickets (id, title, facts)
            VALUES ($1, $2, $3)
        ', [$ticketId, $ticketTitle, $ticketFacts]);
        return new Model($ticketId);
    }
}
