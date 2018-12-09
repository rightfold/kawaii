<?php
declare(strict_types = 1);
namespace Kawaii\ListTickets;

use Kawaii\Common\Web as BaseWeb;
use Kawaii\ListTickets;

final class Web implements BaseWeb {
    /** @var ListTickets */
    private $listTickets;

    public function __construct(ListTickets $listTickets) {
        $this->listTickets = $listTickets;
    }

    public function handle(): int {
        $model = $this->listTickets->listTickets();

        $template = new Html($model);
        $template->renderPage();

        return self::STATUS_HANDLED;
    }
}
