<?php
declare(strict_types = 1);
namespace Kawaii\Ticket;

use Kawaii\Html as BaseHtml;

/**
 * The base class for ticket page HTML templates.
 */
abstract class Html extends BaseHtml {
    public const TICKET_PAGE_FACTS      = 0;
    public const TICKET_PAGE_DISCUSSION = 1;

    /** @var string The title of the ticket. */
    public $ticketTitle;

    /** @var int The page we're on. Must be one of the constants. */
    public $page;

    public function __construct(string $ticketTitle, int $page) {
        $this->ticketTitle = $ticketTitle;
        $this->page = $page;
    }

    /** @return iterable<int,string> */
    public final function getPageTitle(): iterable {
        yield $this->ticketTitle;
        yield from $this->getTicketPageTitle();
    }

    public final function renderPageBody(): void {
        echo '<nav>';
        $this->renderNavButton('Facts', self::TICKET_PAGE_FACTS);
        $this->renderNavButton('Discussion', self::TICKET_PAGE_DISCUSSION);
        echo '</nav>';
        $this->renderTicketPageBody();
    }

    private function renderNavButton(string $label, int $page): void {
        echo '<a href=""';
        if ($this->page === $page) {
            echo ' class="active"';
        }
        echo '>';
        echo \htmlentities($label);
        echo '</a>';
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
