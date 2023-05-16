# PIN generator package

Laravel composer package to generate a unique personal identification number(PIN).

# Install

You can install the package via composer:

```
composer require intellicore/Pin
```

# Config

You can publish the config file with:

```
php artisan vendor:publish --provider="Intellicore\Pin\PinServiceProvider" --tag="config"
```

# Usage

Pin generate example:

```php
$pin = Pin::generate($pin)
``` 
The user can generate pin with different lengths.

```php
$pin = Pin::generate(6)
31847
```
```php
$pin = Pin::generate(12)
617259182461
```


## Change log

Please see the [changelog][3] for more information on what has changed recently.

## Contributing

Contributions are welcome and will be fully credited.

Contributions are accepted via Pull Requests on [Github][4].

## Pull Requests

- **Document any change in behaviour** - Make sure the `readme.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0][5]. Randomly breaking public APIs is not an option.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

## License

license. Please see the [license file][6] for more information.

[3]:    changelog.md
[4]:    https://github.com/intellicore/Package
[5]:    http://semver.org/
[6]:    license.md
