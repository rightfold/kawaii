<?php
declare(strict_types = 1);
namespace Kawaii\Database;

class ConstraintViolationException extends DatabaseException {
    /** @var ?string */
    public $constraintName;

    public function __construct(string $message, ?string $constraintName) {
        parent::__construct($message);
        $this->constraintName = $constraintName;
    }
}
