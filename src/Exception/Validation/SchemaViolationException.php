<?php

namespace Lfbn\JsonResumeValidator\Exception\Validation;

use Exception;
use Throwable;

/**
 * Class SchemaViolationException
 * @package Lfbn\JsonResumeValidator\Exception
 */
class SchemaViolationException extends Exception
{

    /* @var array */
    private $details;

    /**
     * @param string $message
     * @param array $details
     */
    public function __construct(string $message, array $details)
    {
        parent::__construct($message);
        $this->details = $details;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }
}
