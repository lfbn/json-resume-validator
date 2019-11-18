<?php

namespace Lfbn\JsonResumeValidator\Tests\Integration;

use Lfbn\JsonResumeValidator\Exception\FileDoesNotExistsException;
use Lfbn\JsonResumeValidator\Exception\FileIsNotAValidJsonException;
use Lfbn\JsonResumeValidator\JsonResumeValidator;

/**
 * Class InvalidJsonResumeFileTest
 * @package Lfbn\JsonResumeValidator\Tests\Integration
 */
class InvalidFileTest extends BaseTest
{

    /**
     * @throws FileDoesNotExistsException
     * @throws FileIsNotAValidJsonException
     */
    public function testNotExistingFile(): void
    {
        $this->expectException(FileDoesNotExistsException::class);

        JsonResumeValidator::load(
            $this->getDataFullPath('invalid/does-not-exist.txt')
        );
    }

    /**
     * @throws FileDoesNotExistsException
     * @throws FileIsNotAValidJsonException
     */
    public function testFileIsEmpty(): void
    {
        $this->expectException(FileIsNotAValidJsonException::class);

        JsonResumeValidator::load(
            $this->getDataFullPath('invalid/empty-file.json')
        );
    }

    /**
     * @throws FileDoesNotExistsException
     * @throws FileIsNotAValidJsonException
     */
    public function testFileIsInvalidJson(): void
    {
        $this->expectException(FileIsNotAValidJsonException::class);

        JsonResumeValidator::load(
            $this->getDataFullPath('invalid/invalid-json.json')
        );
    }
}
