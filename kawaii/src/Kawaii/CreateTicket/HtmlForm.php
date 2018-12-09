<?php
declare(strict_types = 1);
namespace Kawaii\CreateTicket;

use Kawaii\Common\Html;

/**
 * HTML template of the use case <em>Create ticket</em>.
 */
final class HtmlForm extends Html {
    /** @return iterable<int,string> */
    public function getPageTitle(): iterable {
        return ['Create ticket'];
    }

    public function renderPageBody(): void {
        echo '<form method="post" action="/createTicket">';
        echo '<input type="text" name="title">';
        echo '<textarea name="facts"></textarea>';
        echo '<button>Submit</button>';
        echo '</form>';
    }
}
