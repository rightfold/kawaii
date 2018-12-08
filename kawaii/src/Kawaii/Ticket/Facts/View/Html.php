<?php
declare(strict_types = 1);
namespace Kawaii\Ticket\Facts\View;

use Kawaii\Ticket\Html as BaseHtml;

/**
 * HTML template of the use case <em>View ticket facts</em>.
 */
final class Html extends BaseHtml {
    /** @var string */
    public $ticketFacts;

    public function __construct(Model $model) {
        parent::__construct($model->ticketTitle);
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
