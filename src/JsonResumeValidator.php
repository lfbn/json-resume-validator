<?php

namespace Lfbn\JsonResumeValidator;

use Lfbn\JsonResumeValidator\Exception\FileDoesNotExistsException;
use Lfbn\JsonResumeValidator\Exception\FileIsNotAValidJsonException;
use Lfbn\JsonResumeValidator\Exception\Validation\MandatoryFieldsMissingException;
use Lfbn\JsonResumeValidator\Exception\Validation\SchemaViolationException;
use Lfbn\JsonResumeValidator\Validator\ValidationJsonResumeChain;

/**
 * Class JsonResumeValidator
 */
class JsonResumeValidator
{

    /* @var array */
    private $jsonResume;

    /* @var array */
    private $config;

    /**
     * JsonResumeValidator constructor.
     * @param array $jsonResume
     * @param array $config
     */
    private function __construct(array $jsonResume, array $config = [])
    {
        $this->jsonResume = $jsonResume;
        $this->config = $config;
    }

    /**
     * @param string $jsonResumeFilePathOrUrl
     * @param array $config
     * @return JsonResumeValidator
     * @throws FileIsNotAValidJsonException
     * @throws FileDoesNotExistsException
     */
    public static function load(string $jsonResumeFilePathOrUrl, $config = []): JsonResumeValidator
    {
        if (!filter_var(
                $jsonResumeFilePathOrUrl,
                FILTER_VALIDATE_URL
            ) &&
            !file_exists($jsonResumeFilePathOrUrl)
        ) {
            throw new FileDoesNotExistsException('JSON Resume provided does not exists.');
        }

        $content = file_get_contents($jsonResumeFilePathOrUrl);
        if (empty($content) || !self::isJson($content)) {
            throw new FileIsNotAValidJsonException('JSON Resume provided is not a valid JSON.');
        }

        return new self(json_decode($content, true), $config);
    }

    /**
     * @param string $string
     * @return bool
     */
    private static function isJson(string $string): bool
    {
        $decoded = json_decode($string, true);
        if (!is_array($decoded)) {
            return false;
        }

        return (json_last_error() === JSON_ERROR_NONE);
    }

    /**
     * @return bool
     * @throws MandatoryFieldsMissingException
     * @throws SchemaViolationException
     */
    public function isValid(): bool
    {
        $chain = new ValidationJsonResumeChain();
        $chain->processRequest($this->jsonResume, $this->config);

        return true;
    }
}
