<?php

namespace Lfbn\JsonResumeValidator\Validator\Handler;

use JsonSchema;
use Lfbn\JsonResumeValidator\Exception\Validation\SchemaViolationException;

/**
 * Class SchemaValidationHandler
 * @package Lfbn\JsonResumeValidator\Validator\Handler
 */
class SchemaValidationHandler extends AbstractValidationHandler
{

    /**
     * @param array $jsonResume
     * @return bool
     * @throws SchemaViolationException
     */
    public function handle(array $jsonResume): bool
    {
        $validator = new JsonSchema\Validator();

        $jsonResumeObj = json_decode(json_encode($jsonResume), FALSE);
        $validator->validate(
            $jsonResumeObj,
            (object)['$ref' =>
                'file://' . dirname(__DIR__, 3) . '/data/resume-schema.json']
        );

        if (!$validator->isValid()) {
            throw new SchemaViolationException(
                'The resume violates the JSON Resume schema.',
                $validator->getErrors()
            );
        }

        return true;
    }
}
