<?php
declare(strict_types = 1);
namespace Kawaii\Ticket;

use Kawaii\Html as BaseHtml;

/**
 * The base class for ticket page HTML templates.
 */
abstract class Html extends BaseHtml {
    /** @var string The title of the ticket. */
    public $ticketTitle;

    public function __construct(string $ticketTitle) {
        $this->ticketTitle = $ticketTitle;
    }

    /** @return iterable<int,string> */
    public final function getPageTitle(): iterable {
        yield $this->ticketTitle;
        yield from $this->getTicketPageTitle();
    }

    public final function renderPageBody(): void {
        $this->renderTicketPageBody();
    }

    /**
     * Return the title of the ticket page.
     *
     * @return iterable<int,string> breadcrumbs.
     */
    public abstract function getTicketPageTitle(): iterable;

    /**
     * Render the body of the ticket page.
     */
    public abstract function renderTicketPageBody(): void;
}
