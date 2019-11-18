<?php

namespace Lfbn\JsonResumeValidator\Tests\Integration;

use PHPUnit\Framework\TestCase;

/**
 * Class BaseTest
 * @package Lfbn\JsonResumeValidator\Tests\Integration
 */
abstract class BaseTest extends TestCase
{

    /**
     * @param string $fileName
     * @return string
     */
    protected function getDataFullPath(string $fileName): string
    {
        return __DIR__ . '/data/' . $fileName;
    }
}
