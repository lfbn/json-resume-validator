<?php

namespace Lfbn\JsonResumeValidator\Validator;

use Lfbn\JsonResumeValidator\Exception\Validation\SchemaViolationException;
use Lfbn\JsonResumeValidator\Exception\Validation\MandatoryFieldsMissingException;
use Lfbn\JsonResumeValidator\Validator\Handler\MandatoryFieldsValidationHandler;
use Lfbn\JsonResumeValidator\Validator\Handler\SchemaValidationHandler;
use Lfbn\JsonResumeValidator\Validator\Handler\ValidUrlsValidationHandler;

/**
 * Class ValidationJsonResumeChain
 */
class ValidationJsonResumeChain
{

    /**
     * @param array $jsonResume
     * @param array $config
     * @return bool
     * @throws SchemaViolationException
     * @throws MandatoryFieldsMissingException
     */
    public function processRequest(array $jsonResume, array $config): bool
    {
        $schemaValidation = new SchemaValidationHandler($config);
        $mandatoryFields = new MandatoryFieldsValidationHandler($config);

        $schemaValidation->setNext($mandatoryFields);

        $schemaValidation->handle($jsonResume);
        $mandatoryFields->handle($jsonResume);

        return true;
    }
}
