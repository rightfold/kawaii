<?php
declare(strict_types = 1);
namespace Kawaii\CreateTicket;

use Exception;

/**
 * Thrown when the title of the ticket to be created is empty.
 */
class EmptyTitleException extends Exception {
}
