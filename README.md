# JSON Resume Validator

This is a package who validates if a Resume is in JSON Resume format. It also validates if any desired properties are not empty.

The validations that makes are:

- If complies with JSON Schema of JSON Resume.
- If has certain fields filled in. This is configurable.
- If the country code (basics.countryCode) is in ISO-3166-1 ALPHA-2 format. If this field is empty, is not validated.

## Installing

```
composer require lfbn/json-resume-validator
```

## Usage

```php
// This is optional. You can send an empty array, if you don't want to validate for mandatory fields.
// Use dot notation to define the path to the property.
$config = [
    'mandatory_fields' => [
        'basics.name',
        'basics.email',
        'basics.phone',
        'basics.summary'
    ]
];

// It returns an instance, or it throws an Exception, if it fails to read the file.
$resume = JsonResumeValidator::load(
    $this->getDataFullPath('invalid/missing-mandatory-props.json'),
    $config
);

// It returns true, or it throws an Exception, is it fails in any Validation.
$resume->isValid();
```

## Config

Available parameters:

* mandatory_fields: they should be provided using dot notation. For example, to make name from basics mandatory, send a string "basics.name".

## Integration Tests

This package has integration tests that use several text files to test if the behavior is as expected. 

To execute them, just run:

```php
composer tests
```
