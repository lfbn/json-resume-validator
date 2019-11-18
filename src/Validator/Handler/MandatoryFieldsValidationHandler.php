<?php

namespace Lfbn\JsonResumeValidator\Validator\Handler;

use Adbar\Dot;
use Lfbn\JsonResumeValidator\Exception\Validation\MandatoryFieldsMissingException;

/**
 * Class MandatoryFieldsValidationHandler
 * @package Lfbn\JsonResumeValidator\Validator\Handler
 */
class MandatoryFieldsValidationHandler extends AbstractValidationHandler
{

    /**
     * @param array $jsonResume
     * @return bool
     * @throws MandatoryFieldsMissingException
     */
    public function handle(array $jsonResume): bool
    {
        if (empty($this->config['mandatory_fields'])) {
            return parent::handle($jsonResume);
        }

        $dot = new Dot($jsonResume);

        foreach ($this->config['mandatory_fields'] as $field) {
            if (!empty($dot->get($field))) {
                continue;
            }

            throw new MandatoryFieldsMissingException(
                "The mandatory field ({$field}) is empty."
            );
        }

        return parent::handle($jsonResume);
    }
}
