# JSON Resume Validator

This is a package who validates if a Resume is in JSON Resume format. It also validates if any desired properties are not empty.

The validations it makes are, if:

- It complies with JSON Schema of JSON Resume.
- It has certain fields filled in. These are configurable.

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

* mandatory_fields: they should be provided using dot notation. For example, to make name from basics mandatory, send an element with a string "basics.name".
