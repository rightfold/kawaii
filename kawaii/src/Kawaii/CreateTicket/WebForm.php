<?php
declare(strict_types = 1);
namespace Kawaii\CreateTicket;

use Kawaii\Common\Web as BaseWeb;

final class WebForm implements BaseWeb {
    public function handle(): int {
        $template = new HtmlForm();
        $template->renderPage();
        return self::STATUS_HANDLED;
    }
}
