<?php
declare(strict_types = 1);
namespace Kawaii;

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
        echo '<title>';
        echo \htmlentities(Iterables::implode(' > ', $this->getPageTitle()));
        echo '</title>';
        echo '</head>';
        echo '<body>';
        echo '<h1>';
        echo \htmlentities(Iterables::implode(' > ', $this->getPageTitle()));
        echo '</h1>';
        $this->renderPageBody();
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
