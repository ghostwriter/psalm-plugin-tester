# psalm-plugin-tester

[![Compliance](https://github.com/ghostwriter/psalm-plugin-tester/actions/workflows/compliance.yml/badge.svg)](https://github.com/ghostwriter/psalm-plugin-tester/actions/workflows/compliance.yml)
[![Supported PHP Version](https://badgen.net/packagist/php/ghostwriter/psalm-plugin-tester?color=8892bf)](https://www.php.net/supported-versions)
[![Mutation Coverage](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fghostwriter%2Fwip%2Fmain)](https://dashboard.stryker-mutator.io/reports/github.com/ghostwriter/psalm-plugin-tester/main)
[![Code Coverage](https://codecov.io/gh/ghostwriter/psalm-plugin-tester/branch/main/graph/badge.svg?token=UPDATE_TOKEN)](https://codecov.io/gh/ghostwriter/psalm-plugin-tester)
[![Type Coverage](https://shepherd.dev/github/ghostwriter/psalm-plugin-tester/coverage.svg)](https://shepherd.dev/github/ghostwriter/psalm-plugin-tester)
[![Latest Version on Packagist](https://badgen.net/packagist/v/ghostwriter/psalm-plugin-tester)](https://packagist.org/packages/ghostwriter/psalm-plugin-tester)
[![Downloads](https://badgen.net/packagist/dt/ghostwriter/psalm-plugin-tester?color=blue)](https://packagist.org/packages/ghostwriter/psalm-plugin-tester)

work in progress

> **Warning**
>
> This project is not finished yet, work in progress.

## Installation

You can install the package via composer:

``` bash
composer require ghostwriter/psalm-plugin-tester --dev
```

## Usage

- Create a `tests/Fixture/` directory.
- Create a PHPUnit test using the example below.

```php
<?php

declare(strict_types=1);

namespace Vendor\Package\Tests;

use Generator;
use Vendor\Package\Plugin;
use Ghostwriter\PsalmPluginTester\PluginTester;
use PHPUnit\Framework\TestCase;

final class PluginTest extends TestCase
{
    private PluginTester $pluginTester;

    protected function setUp(): void
    {
        $this->pluginTester = new PluginTester();
    }

    public static function fixtureDataProvider(): Generator
    {
        yield from PluginTester::yieldFixtures(
            // Replace path to "test/Fixture" directory.
            dirname(__FILE__, 2) . '/Fixture'
        );
    }

    /** @dataProvider fixtureDataProvider */
    public function testPlugin(Fixture $fixture): void
    {
        foreach ([Version::PHP_80, Version::PHP_81, Version::PHP_82] as $phpVersion) {
            // Replace "Plugin::class" with the class name of the Plugin you want to test.
            $this->pluginTester->testPlugin(Plugin::class, $fixture, $phpVersion);
        }
    }

    public static function fixtureWarningDataProvider(): Generator
    {
        yield from PluginTester::yieldFixtures(
            // Replace "test/Fixture/Warnings" path.
            dirname(__FILE__, 2) . '/Fixture/Warning'
        );
    }

    /** @dataProvider fixtureWarningDataProvider */
    public function testPluginWarning(Fixture $fixture): void
    {
        $this->pluginTester->testPlugin(Plugin::class, $fixture);
    }

    public static function fixtureErrorDataProvider(): Generator
    {
        yield from PluginTester::yieldFixtures(
            // Replace "test/Fixture/Errors" path.
            dirname(__FILE__, 2) . '/Fixture/Errors'
        );
    }

    /** @dataProvider fixtureErrorDataProvider */
    public function testPluginErrors(Fixture $fixture): void
    {
        $this->pluginTester->testPlugin(Plugin::class, $fixture);
    }
}
```

- You can manually create an `expectation.json` file in the `psalm-runs-without-any-errors` directory or **run phpunit to automatcally generate `expectation.json`, `psalm.xml`, and an `autoload.php` for you.**

> Manually

- add your expectation in JSON format, 3 fields (file, type, message).

> // No errors `expectation.json`
>
>    ```json
> {
>     "pluginClass": "Vendor\\Package\\Plugin",
>     "php": "8.0",
>     "expected": {
>         "errors": []
>     },
>     "actual": {
>         "errors": []
>     },
>     "plugin": {
>         "Vendor\\Package\\Plugin": {
>             "phpVersion": "8.0"
>         }
>     },
>     "TypeInferenceSummary": "No files analyzed\nPsalm was unable to infer types in the codebase"
> }
>    ```

> // Has Errors `expectation.json`
>
>    ```json
>    {
>        "pluginClass": "Vendor\\Package\\Plugin",
>        "php": "8.0",
>        "expected": {
>            "errors": [
>                {
>                    "file": "code.php",
>                    "message": "Class Vendor\\Package\\MyTestCase is never used",
>                    "severity": "error",
>                    "type": "UnusedClass"
>                }
>            ]
>        },
>        "actual": {
>            "errors": [
>                {
>                    "file": "code.php",
>                    "message": "Class Vendor\\Package\\MyTestCase is never used",
>                    "severity": "error",
>                    "type": "UnusedClass"
>                }
>            ]
>        },
>        "plugin": {
>            "Vendor\\Package\\Plugin": {
>                "phpVersion": "8.0"
>            }
>        },
>        "TypeInferenceSummary": "Psalm was able to infer types for 100% of the codebase"
>    }
>    ```
>

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG.md](./CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email `nathanael.esayeas@protonmail.com` instead of using the issue tracker.

## Support

[[`Become a GitHub Sponsor`](https://github.com/sponsors/ghostwriter)]

## Thank you

To acknowledge the efforts of those who create and maintain valuable projects for the community.

Thank you to [Bruce Weirdan](https://github.com/weirdan) for the original [`psalm/codeception-psalm-module`](https://github.com/psalm/codeception-psalm-module) that served as the starting point for my work.

Thank you to [Matt Brown](https://github.com/muglug), the creator of [`vimeo/psalm`](https://github.com/vimeo/psalm), a fantastic tool for static analysis in PHP.

Special thanks to [@orklah](https://github.com/orklah) for maintaining [`vimeo/psalm`](https://github.com/vimeo/psalm), ensuring its continuous improvement and functionality.

## Credits

- [Nathanael Esayeas](https://github.com/ghostwriter)
- [All Contributors](https://github.com/ghostwriter/psalm-plugin-tester/contributors)

## License

The BSD-3-Clause. Please see [License File](./LICENSE) for more information.
