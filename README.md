# Conventions for PHP Code

This development tool provides a pre-defined configuration for [GrumPHP](https://github.com/phpro/grumphp) with the following checks enabled:

* composer.json validation,
* composer.json normalization ([ergebnis/composer-normalize](https://packagist.org/packages/ergebnis/composer-normalize)),
* YAML Lint,
* JSON Lint,
* PHP Lint ([php-parallel-lint/php-parallel-lint](https://packagist.org/packages/php-parallel-lint/php-parallel-lint)),
* Twig CS ([friendsoftwig/twigcs](https://packagist.org/packages/friendsoftwig/twigcs)),
* PHP CS ([PHP CS](https://packagist.org/packages/squizlabs/php_codesniffer)),

The package provides a default configuration for each task, and it's customizable at will through a simple configuration file.

The package will install the required dependencies, so it works out of the box.

Tasks can be also added or skipped according to your need.

## Installation

```shell
composer require ised-isde/conventions-php:^1 --dev
```

### If you're not using GrumPHP

Manually add to your `composer.json` file

```yaml
    "extra": {
        "grumphp": {
            "config-default-path": "vendor/ised-isde/conventions-php/config/php73/grumphp.yml"
        }
    }
```

Replace the string `php73` with the minimal version of php you want to support.

Current choices are:

* `psr12`
* `php71`
* `php73`

### If you're using GrumPHP already

Edit the file `grumphp.yml.dist` or `grumphp.yml` and add on the top it:

```yaml
imports:
  - { resource: vendor/ised-isde/conventions-php/config/php73/grumphp.yml }
```

To add an extra Grumphp task:

```yaml
imports:
  - { resource: vendor/ised-isde/conventions-php/config/php73/grumphp.yml }

parameters:
  extra_tasks:
    infection:
      threads: 1
      test_framework: phpspec
      configuration: infection.json.dist
      min_msi: 60
      min_covered_msi: 60
  skip_tasks:
    - phpcs
```

In conjunction with `extra_tasks`, use `skip_tasks` to skip tasks if needed.

### Testsuites

Do you want to specify some pre-defined tasks you want to run? It is easy to configure and run custom estsuites.

Available testsuites are:

* becs (composer, composer_normalize, yamllint, phplint, phpcs)
* fecs (composer, composer_normalize, yamllint, jsonlint, twigcs, eslint)
* security (securitychecker)

To run a particular testsuite:

`./vendor/bin/grumphp run --testsuite=becs`

