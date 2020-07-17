<?php

namespace Lfbn\JsonResumeValidator\Tests\Integration;

use Lfbn\JsonResumeValidator\Exception\FileDoesNotExistsException;
use Lfbn\JsonResumeValidator\Exception\FileIsNotAValidJsonException;
use Lfbn\JsonResumeValidator\Exception\Validation\MandatoryFieldsMissingException;
use Lfbn\JsonResumeValidator\Exception\Validation\SchemaViolationException;
use Lfbn\JsonResumeValidator\JsonResumeValidator;

/**
 * Class MandatoryPropsTest
 * @package Lfbn\JsonResumeValidator\Tests\Integration
 */
class MandatoryPropsTest extends BaseTest
{

    /**
     * @throws FileDoesNotExistsException
     * @throws FileIsNotAValidJsonException
     * @throws MandatoryFieldsMissingException
     * @throws SchemaViolationException
     */
    public function testItShouldValidateIfDoesNotHaveMandatoryProps(): void
    {
        $this->expectException(MandatoryFieldsMissingException::class);

        $config = [
            'mandatory_fields' => [
                'basics.name',
                'basics.email',
                'basics.phone',
                'basics.summary'
            ]
        ];

        $resume = JsonResumeValidator::load(
            $this->getDataFullPath('invalid/missing-mandatory-props.json'),
            $config
        );

        $this->assertTrue($resume->isValid());
    }

    /**
     * @throws FileDoesNotExistsException
     * @throws FileIsNotAValidJsonException
     * @throws MandatoryFieldsMissingException
     * @throws SchemaViolationException
     */
    public function testItShouldBeValidIfItHasAllMandatoryPropsFilled(): void
    {
        $config = [
            'mandatory_fields' => [
                'basics.name',
                'basics.email',
                'basics.phone',
                'basics.summary'
            ]
        ];

        $resume = JsonResumeValidator::load(
            $this->getDataFullPath('valid/complete.json'),
            $config
        );

        $this->assertTrue($resume->isValid());
    }
}
