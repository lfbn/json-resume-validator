# JSON Resume Validator

This is a package that validates if a Resume is in JSON Resume format. It also validates if any desired properties are not empty.

The validations that make are:

- If complies with JSON Schema of JSON Resume.
- It has certain fields filled in. This is configurable.
- If the country code (basics.countryCode) is in ISO-3166-1 ALPHA-2 format. If this field is empty, is not validated.

## Installing

```
composer require lfbn/json-resume-validator
```

## Usage

### As a CLI

Just clone the project, and run. Follow the instructions.

```
./bin/jr-validate
```

### In your project

First, install it, using composer:

```
composer require lfbn/json-resume-validator
```

Then, create an instance, and call the isValid() method.

```php
$path = 'json_resume.json';

$validator = Lfbn\JsonResumeValidator\JsonResumeValidator::load($path);

echo 'Is valid? '.$validator->isValid();
```

Encapsulate the isValid() method inside a try/catch. This method will return true if the file is valid or throws an exception if is not valid.

The name of the exception has the description of the error it has.

#### Your mandatory fields

You can, optionally, define the mandatory fields you want.

Just define them using dot notation.

```php
$config = [
    'mandatory_fields' => [
        'basics.name',
        'basics.email',
        'basics.phone',
        'basics.summary'
    ]
];

$path = 'json_resume.json';
$resume = Lfbn\JsonResumeValidator\JsonResumeValidator::load($path, $config);

// It returns true, or it throws an Exception, is it fails in any Validation.
$resume->isValid();
```

## Tests

This package has tests that use several JSON files to test if the behavior is as expected.

To execute them, just run:

```php
composer tests
```
