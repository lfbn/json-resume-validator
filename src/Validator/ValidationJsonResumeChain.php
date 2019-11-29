<?php

namespace Lfbn\JsonResumeValidator\Validator;

use Lfbn\JsonResumeValidator\Exception\Validation\InvalidCountryCodeException;
use Lfbn\JsonResumeValidator\Exception\Validation\SchemaViolationException;
use Lfbn\JsonResumeValidator\Exception\Validation\MandatoryFieldsMissingException;
use Lfbn\JsonResumeValidator\Validator\Handler\CountryCodeValidationHandler;
use Lfbn\JsonResumeValidator\Validator\Handler\MandatoryFieldsValidationHandler;
use Lfbn\JsonResumeValidator\Validator\Handler\SchemaValidationHandler;

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
     * @throws InvalidCountryCodeException
     */
    public function processRequest(array $jsonResume, array $config): bool
    {
        $schemaValidation = new SchemaValidationHandler($config);
        $mandatoryFields = new MandatoryFieldsValidationHandler($config);
        $countryCode = new CountryCodeValidationHandler($config);

        $schemaValidation->setNext($mandatoryFields)->setNext($countryCode);

        $schemaValidation->handle($jsonResume);
        $mandatoryFields->handle($jsonResume);
        $countryCode->handle($jsonResume);

        return true;
    }
}
