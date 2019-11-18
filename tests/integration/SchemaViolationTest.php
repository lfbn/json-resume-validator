<?php

namespace Lfbn\JsonResumeValidator\Tests\Integration;

use Lfbn\JsonResumeValidator\Exception\FileDoesNotExistsException;
use Lfbn\JsonResumeValidator\Exception\FileIsNotAValidJsonException;
use Lfbn\JsonResumeValidator\Exception\Validation\MandatoryFieldsMissingException;
use Lfbn\JsonResumeValidator\Exception\Validation\SchemaViolationException;
use Lfbn\JsonResumeValidator\JsonResumeValidator;

/**
 * Class SchemaViolationTest
 * @package Lfbn\JsonResumeValidator\Tests\Integration
 */
class SchemaViolationTest extends BaseTest
{

    /**
     * @throws FileDoesNotExistsException
     * @throws FileIsNotAValidJsonException
     * @throws SchemaViolationException
     * @throws MandatoryFieldsMissingException
     */
    public function testDoesNotHaveMandatoryProps(): void
    {
        $this->expectException(SchemaViolationException::class);

        $resume = JsonResumeValidator::load(
            $this->getDataFullPath('invalid/complete-invalid-url.json')
        );

        $this->assertTrue($resume->isValid());
    }

    /**
     * @throws FileDoesNotExistsException
     * @throws FileIsNotAValidJsonException
     * @throws MandatoryFieldsMissingException
     * @throws SchemaViolationException
     */
    public function testHasAllMandatoryProps(): void
    {
        $resume = JsonResumeValidator::load(
            $this->getDataFullPath('valid/complete.json')
        );

        $this->assertTrue($resume->isValid());
    }
}
