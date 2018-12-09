<?php
declare(strict_types = 1);
namespace Kawaii\CreateTicket;

/**
 * Model of the use case <em>Create ticket</em>.
 */
final class Model {
    /** @var string */
    public $ticketId;

    public function __construct(string $ticketId) {
        $this->ticketId = $ticketId;
    }
}
