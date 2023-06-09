# PIN generator package

Laravel composer package to generate a unique personal identification number(PIN).

# Install

Install the package via composer:

```
composer require intellicore/Pin
```

# Config

Publish the config file with:

```
php artisan vendor:publish --provider="Intellicore\Pin\PinServiceProvider" --tag="config"
```

# Usage

#### Import the package into the controller
Pin generate example:

```php
$pin = Pin::generate()
3163
``` 
The user can generate pin with different lengths.

```php
$pin = Pin::generate(6)
318472
```
```php
$pin = Pin::generate(12)
681725927467
```


## Change log

Please see the [changelog][3] for more information on what has changed recently.

## Pull Requests

Contributions are welcome and will be fully credited.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

- **Document any change in behaviour** - Make sure the `readme.md` and any other relevant documentation are kept up-to-date.

Contributions are accepted via Pull Requests on [Github][4].

## Pull Requests

- **Document any change in behaviour** - Make sure the `readme.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0][5]. Randomly breaking public APIs is not an option.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

## License

license. Please see the [license file][6] for more information.

[3]:    changelog.md
[4]:    https://github.com/danielhagos1/pin-generator-package/
[5]:    http://semver.org/
[6]:    license.md
