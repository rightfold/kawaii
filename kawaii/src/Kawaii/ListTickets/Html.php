<?php
declare(strict_types = 1);
namespace Kawaii\ListTickets;

use Kawaii\Common\Html as BaseHtml;

/**
 * HTML template of the use case <em>List tickets</em>.
 */
final class Html extends BaseHtml {
    /** @var iterable<int,Model> */
    public $model;

    /** @param iterable<int,Model> $model */
    public function __construct(iterable $model) {
        $this->model = $model;
    }

    /** @return iterable<int,string> */
    public function getPageTitle(): iterable {
        return ['Tickets'];
    }

    public function renderPageBody(): void {
        echo '<table>';
        echo '<tbody>';
        foreach ($this->model as $model) {
            echo '<tr>';
            $this->renderTicketTitleCell($model);
            $this->renderViewTicketFactsCell($model);
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }

    private function renderTicketTitleCell(Model $model): void {
        echo '<td>';
        echo \htmlentities($model->ticketTitle);
        echo '</td>';
    }

    private function renderViewTicketFactsCell(Model $model): void {
        echo '<td>';
        echo '<a href="/viewTicketFacts?ticketId=' . $model->ticketId . '">';
        echo 'View ticket facts';
        echo '</a>';
        echo '</td>';
    }
}
