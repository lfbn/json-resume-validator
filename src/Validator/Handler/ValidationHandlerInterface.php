<?php

namespace Lfbn\JsonResumeValidator\Validator\Handler;

/**
 * Interface ValidationHandlerInterface
 * @package Lfbn\JsonResumeValidator\Validator\Handler
 */
interface ValidationHandlerInterface
{

    /**
     * @param ValidationHandlerInterface $handler
     * @return ValidationHandlerInterface
     */
    public function setNext(ValidationHandlerInterface $handler): ValidationHandlerInterface;

    /**
     * @param array $jsonResumeData
     * @return bool
     */
    public function handle(array $jsonResumeData): bool;
}
