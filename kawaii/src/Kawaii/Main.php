<?php
declare(strict_types = 1);
namespace Kawaii;

use Kawaii\Common\Html;

final class Main {
    public function main(): void {
        /** @var string */
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestPath = \explode('?', $requestUri, 2)[0];

        switch ($requestPath) {
        case '/view-ticket-facts': $this->viewTicketFacts(); break;
        default: $this->respondNotFound(); break;
        }
    }

    public function viewTicketFacts(): void {
        $ticketId = (string)$_GET['ticketId'];

        $database = new Database\Connection('host=localhost user=kawaii_application password=kawaii_application dbname=kawaii');
        $ticketFactsView = new ViewTicketFacts($database);
        $model = $ticketFactsView->viewTicketFacts($ticketId);

        if ($model === NULL) {
            $this->respondNotFound();
            return;
        }

        $template = new ViewTicketFacts\Html($model);
        $this->respondOk($template);
    }

    public function respondOk(Html $template): void {
        $template->renderPage();
    }

    public function respondNotFound(): void {
        \header('HTTP/1.1 404 Not Found');
        echo 'Not found';
    }
}
