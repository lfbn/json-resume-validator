<?php

namespace Lfbn\JsonResumeValidator\Tests\Integration;

use Lfbn\JsonResumeValidator\Exception\FileDoesNotExistsException;
use Lfbn\JsonResumeValidator\Exception\FileIsNotAValidJsonException;
use Lfbn\JsonResumeValidator\Exception\Validation\InvalidCountryCodeException;
use Lfbn\JsonResumeValidator\Exception\Validation\MandatoryFieldsMissingException;
use Lfbn\JsonResumeValidator\Exception\Validation\SchemaViolationException;
use Lfbn\JsonResumeValidator\JsonResumeValidator;

/**
 * Class InvalidCountryTest
 * @package Lfbn\JsonResumeValidator\Tests\Integration
 */
class InvalidCountryTest extends BaseTest
{

    /**
     * @throws FileDoesNotExistsException
     * @throws FileIsNotAValidJsonException
     * @throws MandatoryFieldsMissingException
     * @throws SchemaViolationException
     * @throws InvalidCountryCodeException
     */
    public function testItShouldValidateIfTheCountryIsValid(): void
    {
        $this->expectException(InvalidCountryCodeException::class);

        $resume = JsonResumeValidator::load(
            $this->getDataFullPath('invalid/invalid-country.json')
        );

        $this->assertTrue($resume->isValid());
    }
}
