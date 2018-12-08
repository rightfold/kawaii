<?php
declare(strict_types = 1);
namespace Kawaii;

final class Main {
    private function __construct() {
    }

    public static function main(): void {
        $database = new Database\Connection('host=localhost user=kawaii_application password=kawaii_application dbname=kawaii');
        $view = new Ticket\Facts\View($database);

        $ticketId = 'bae4ec89-927b-4a67-b72a-c9722359e401';
        $model = $view->viewTicketFacts($ticketId);
        assert($model != NULL);
        $template = new Ticket\Facts\View\Html($model);
        $template->renderPage();
    }
}
