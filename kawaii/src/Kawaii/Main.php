<?php
declare(strict_types = 1);
namespace Kawaii;

final class Main {
    private function __construct() {
    }

    public static function main(): void {
        $database = new Database\Connection('host=localhost user=kawaii_application password=kawaii_application dbname=kawaii');

        $ticketId = 'bae4ec89-927b-4a67-b72a-c9722359e401';
        list($title, $facts) = self::getTitleAndFacts($database, $ticketId);
        $template = new Ticket\Facts\Html($title, $facts);
        $template->renderPage();
    }

    /**
     * @return ?array{0:string,1:string}
     */
    private static function getTitleAndFacts(Database\Connection $database, string $ticketId): ?array {
        $result = $database->query('
            SELECT title, facts
            FROM kawaii.tickets
            WHERE id = $1
        ', [$ticketId]);
        foreach ($result as list($title, $facts)) {
            assert($title !== NULL);
            assert($facts !== NULL);
            return [$title, $facts];
        }
        return NULL;
    }
}
