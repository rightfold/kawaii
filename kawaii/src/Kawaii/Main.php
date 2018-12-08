<?php
declare(strict_types = 1);
namespace Kawaii;

final class Main {
    private function __construct() {
    }

    public static function main(): void {
        $template = new Ticket\Facts\Html('It is broken', 'These are facts');
        $template->renderPage();
    }
}
