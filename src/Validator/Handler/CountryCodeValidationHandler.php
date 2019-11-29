<?php

namespace Lfbn\JsonResumeValidator\Validator\Handler;

use Adbar\Dot;
use Exception;
use League\ISO3166\ISO3166;
use Lfbn\JsonResumeValidator\Exception\Validation\InvalidCountryCodeException;

/**
 * Class CountryCodeValidationHandler
 * @package Lfbn\JsonResumeValidator\Validator\Handler
 */
class CountryCodeValidationHandler extends AbstractValidationHandler
{

    /**
     * @param array $jsonResume
     * @return bool
     * @throws InvalidCountryCodeException
     */
    public function handle(array $jsonResume): bool
    {
        $dot = new Dot($jsonResume);
        $countryCode = $dot->get('basics.location.countryCode');

        if (empty($countryCode)) {
            return true;
        }

        try {
             (new ISO3166())->alpha2($countryCode);
        } catch (Exception $e) {
            throw new InvalidCountryCodeException(
                "The country code ({$countryCode}) is not compliant."
            );
        }

        return parent::handle($jsonResume);
    }
}
