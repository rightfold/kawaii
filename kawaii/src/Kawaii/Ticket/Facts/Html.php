<?php
declare(strict_types = 1);
namespace Kawaii\Ticket\Facts;

use Kawaii\Ticket\Html as BaseHtml;

/**
 * Ticket facts HTML templates.
 */
final class Html extends BaseHtml {
    /** @var string The facts. */
    public $facts;

    public function __construct(string $ticketTitle, string $facts) {
        parent::__construct($ticketTitle);
        $this->facts = $facts;
    }

    /** @return iterable<int,string> */
    public function getTicketPageTitle(): iterable {
        return ['Facts'];
    }

    public function renderTicketPageBody(): void {
        echo '<pre>';
        echo \htmlentities($this->facts);
        echo '</pre>';
    }
}
