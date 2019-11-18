<?php

namespace Lfbn\JsonResumeValidator\Validator\Handler;

/**
 * Class AbstractHandler
 * @package Lfbn\JsonResumeValidator\Validator\Handler
 */
abstract class AbstractValidationHandler implements ValidationHandlerInterface
{

    /* @var array */
    protected $config;

    /* @var ValidationHandlerInterface */
    private $nextHandler;

    /**
     * AbstractValidationHandler constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param ValidationHandlerInterface $handler
     * @return ValidationHandlerInterface
     */
    public function setNext(ValidationHandlerInterface $handler): ValidationHandlerInterface
    {
        $this->nextHandler = $handler;

        return $handler;
    }

    /**
     * @param array $jsonResumeData
     * @return bool
     */
    public function handle(array $jsonResumeData): bool
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($jsonResumeData);
        }

        return true;
    }
}
