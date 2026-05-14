<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Exception;

use RuntimeException;
use Throwable;

class ValidationException extends RuntimeException
{
    public function __construct(
        string     $message = '',
        int        $code = 422,
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}