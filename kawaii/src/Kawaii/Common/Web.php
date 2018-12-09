<?php
declare(strict_types = 1);
namespace Kawaii\Common;

/**
 * Request handler.
 */
interface Web {
    public const STATUS_HANDLED   = 0;
    public const STATUS_NOT_FOUND = 404;

    /**
     * Read the superglobals and request body and optionally write the
     * response. If the response was written, return
     * {@see self::STATUS_HANDLED}. Otherwise return the appropriate status
     * code.
     */
    public function handle(): int;
}
