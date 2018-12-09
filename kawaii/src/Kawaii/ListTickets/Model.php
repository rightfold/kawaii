<?php
declare(strict_types = 1);
namespace Kawaii\ListTickets;

/**
 * Model of the use case <em>List tickets</em>.
 */
final class Model {
    /** @var string */
    public $ticketId;

    /** @var string */
    public $ticketTitle;

    public function __construct(string $ticketId, string $ticketTitle) {
        $this->ticketId = $ticketId;
        $this->ticketTitle = $ticketTitle;
    }
}
