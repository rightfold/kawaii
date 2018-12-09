<?php
declare(strict_types = 1);
namespace Kawaii\ViewTicketFacts;

use Kawaii\Common\Web as BaseWeb;
use Kawaii\ViewTicketFacts;

final class Web implements BaseWeb {
    /** @var ViewTicketFacts */
    private $viewTicketFacts;

    public function __construct(ViewTicketFacts $viewTicketFacts) {
        $this->viewTicketFacts = $viewTicketFacts;
    }

    public function handle(): int {
        $ticketId = (string)$_GET['ticketId'];

        $model = $this->viewTicketFacts->viewTicketFacts($ticketId);

        if ($model === NULL) {
            return self::STATUS_NOT_FOUND;
        }

        $template = new Html($model);
        $template->renderPage();

        return self::STATUS_HANDLED;
    }
}
