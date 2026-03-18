<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Exception\Handler;

use Hyperf\Codec\Json;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use kooditorm\Validation\Exception\ValidationException;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Hyperf\ExceptionHandler\Annotation\ExceptionHandler as RegisterHandler;

#[RegisterHandler(server: 'http')]
class ValidateExceptionHandler extends ExceptionHandler
{

    public function handle(Throwable $throwable, ResponseInterface $response): MessageInterface|ResponseInterface
    {
        if ($throwable instanceof ValidationException) {
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->withBody(new SwooleStream(Json::encode([
                'code' => $throwable->getCode(),
                'message' => $throwable->getMessage()
            ])));
        }
        return $response;
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}