<?php
declare(strict_types = 1);
namespace Kawaii\Ticket\Facts\View;

/**
 * Model of the use case <em>View ticket facts</em>.
 */
final class Model {
    /** @var string */
    public $ticketTitle;

    /** @var string */
    public $ticketFacts;

    public function __construct(string $ticketTitle, string $ticketFacts) {
        $this->ticketTitle = $ticketTitle;
        $this->ticketFacts = $ticketFacts;
    }
}
