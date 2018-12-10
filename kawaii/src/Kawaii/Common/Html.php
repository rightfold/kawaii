<?php
declare(strict_types = 1);
namespace Kawaii\Common;

use Kawaii\Utility\Iterables;

/**
 * The base class for HTML templates.
 */
abstract class Html {
    /**
     * Render the HTML template.
     */
    public final function renderPage(): void {
        echo '<!DOCTYPE html>';
        echo '<html>';
        echo '<head>';
        echo '<meta charset="utf-8">';
        echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese">';
        echo '<link rel="stylesheet" href="/client/kawaii.css">';
        echo '<title>';
        echo \htmlentities(Iterables::implode(' > ', $this->getPageTitle()));
        echo '</title>';
        echo '</head>';
        echo '<body>';
        echo '<header class="kawaii--header">';
        echo 'Kawaii';
        echo '</header>';
        echo '<section class="kawaii--body">';
        echo '<h1>';
        echo \htmlentities(Iterables::implode(' > ', $this->getPageTitle()));
        echo '</h1>';
        $this->renderPageBody();
        echo '</section>';
        echo '</body>';
        echo '</html>';
    }

    /**
     * Return the title of the page.
     *
     * @return iterable<int,string> breadcrumbs.
     */
    public abstract function getPageTitle(): iterable;

    /**
     * Render the body of the page.
     */
    public abstract function renderPageBody(): void;
}
