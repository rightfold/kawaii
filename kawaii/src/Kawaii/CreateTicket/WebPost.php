<?php
declare(strict_types = 1);
namespace Kawaii\CreateTicket;

use Kawaii\Common\Web as BaseWeb;
use Kawaii\CreateTicket;

final class WebPost implements BaseWeb {
    /** @var CreateTicket */
    private $createTicket;

    public function __construct(CreateTicket $createTicket) {
        $this->createTicket = $createTicket;
    }

    public function handle(): int {
        $ticketTitle = (string)$_POST['title'];
        $ticketFacts = (string)$_POST['facts'];

        $model = $this->createTicket->createTicket($ticketTitle, $ticketFacts);

        \header('HTTP/1.1 303 See Other');
        \header('Location: /view-ticket-facts?ticketId=' . $model->ticketId);

        return self::STATUS_HANDLED;
    }
}
