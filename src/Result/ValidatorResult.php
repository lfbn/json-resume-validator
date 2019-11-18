<?php

namespace Lfbn\JsonResumeValidator\Result;

/**
 * Class ValidatorResult
 * @package Lfbn\JsonResumeValidator\Result
 */
class ValidatorResult
{

    /**
     * @var bool
     */
    private $wasSuccessful;

    /**
     * @var string[]
     */
    private $failureReasons;

    /**
     * ValidatorResult constructor.
     * @param bool $wasSuccessful
     */
    public function __construct(
        bool $wasSuccessful
    ) {
        $this->wasSuccessful = $wasSuccessful;
    }

    /**
     * @param string $reason
     * @return ValidatorResult
     */
    public function addFailureReason(string $reason): ValidatorResult
    {
        $this->failureReasons[] = $reason;

        return $this;
    }

    /**
     * @return bool
     */
    public function wasSucessful(): bool
    {
        return $this->wasSuccessful;
    }
}
