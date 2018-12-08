<?php
declare(strict_types = 1);
namespace Kawaii;

final class Lol extends Ticket\Html {
    /** @return iterable<int,string> */
    public function getTicketPageTitle(): iterable {
        return ['Lol'];
    }

    public function renderTicketPageBody(): void {
        echo '<strong>u dun goofed m8</strong>';
    }
}

final class Main {
    private function __construct() {
    }

    public static function main(): void {
        $template = new Lol('Leuke ticket!');
        $template->renderPage();
    }
}
