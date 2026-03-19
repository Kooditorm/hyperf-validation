<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Exception;

use Throwable;

class ValidationException extends \RuntimeException
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