<?php
declare(strict_types = 1);
namespace Kawaii;

use Kawaii\Common\Html;
use Kawaii\Common\Web;

final class Main {
    /** @var Database\Connection */
    private $database;

    /** @var CreateTicket */
    private $createTicket;

    /** @var Web */
    private $createTicketWebForm;

    /** @var Web */
    private $createTicketWebPost;

    /** @var ViewTicketFacts */
    private $viewTicketFacts;

    /** @var Web */
    private $viewTicketFactsWeb;

    public function __construct() {
        $this->database = new Database\Connection('host=localhost user=kawaii_application password=kawaii_application dbname=kawaii');

        $this->createTicket = new CreateTicket($this->database);
        $this->createTicketWebForm = new CreateTicket\WebForm();
        $this->createTicketWebPost = new CreateTicket\WebPost($this->createTicket);

        $this->viewTicketFacts = new ViewTicketFacts($this->database);
        $this->viewTicketFactsWeb = new ViewTicketFacts\Web($this->viewTicketFacts);
    }

    public function main(): void {
        /** @var string */
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        /** @var string */
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestPath = \explode('?', $requestUri, 2)[0];

        switch ($requestMethod . $requestPath) {
        case 'GET/create-ticket':     $status = $this->createTicketWebForm->handle(); break;
        case 'POST/create-ticket':    $status = $this->createTicketWebPost->handle(); break;
        case 'GET/view-ticket-facts': $status = $this->viewTicketFactsWeb->handle(); break;
        default: $status = Web::STATUS_NOT_FOUND; break;
        }

        if ($status !== Web::STATUS_HANDLED) {
            \header('HTTP/1.1 ' . (string)$status);
            echo 'Status ' . (string)$status;
        }
    }
}
