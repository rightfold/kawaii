<?php
declare(strict_types = 1);
namespace Kawaii\ViewTicketFacts;

use Kawaii\Common\TicketHtml;

/**
 * HTML template of the use case <em>View ticket facts</em>.
 */
final class Html extends TicketHtml {
    /** @var string */
    private $ticketFacts;

    public function __construct(Model $model) {
        parent::__construct($model->ticketTitle, self::TICKET_PAGE_FACTS);
        $this->ticketFacts = $model->ticketFacts;
    }

    /** @return iterable<int,string> */
    public function getTicketPageTitle(): iterable {
        return ['Facts'];
    }

    public function renderTicketPageBody(): void {
        echo '<pre>';
        echo \htmlentities($this->ticketFacts);
        echo '</pre>';
    }
}
