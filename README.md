# Nova Difference

[![Latest Version on Packagist](https://img.shields.io/packagist/v/youbar/nova-difference)](https://packagist.org/packages/youbar/nova-difference)
[![Total Downloads](https://img.shields.io/packagist/dt/youbar/nova-difference)](https://packagist.org/packages/youbar/nova-difference)
[![License](https://img.shields.io/packagist/l/youbar/nova-difference)](https://github.com/YouneselBarnoussi/nova-difference/blob/develop/LICENSE)

A Laravel Nova field to display the difference between to values. Especially useful with the use of [Laravel Auditing](https://github.com/owen-it/laravel-auditing)

# Installation

You can install the package via composer:

```
composer require youbar/nova-difference
```

## Usage

Basic demo showing the power of this field:

```php

use Youbar\Difference\Difference;

class ExampleNovaResource extends Resource {

    public function fields(Request $request)
    {
        return [
            Difference::make('Difference', 'old_values', 'new_values'),
        ];
    }

}
```

## Demo

![Index Field](https://github.com/YouneselBarnoussi/nova-difference/blob/develop/assets/index.png)
![Index Field](https://github.com/YouneselBarnoussi/nova-difference/blob/develop/assets/detail.png)

## License

The MIT License (MIT). Please see [License File](https://raw.githubusercontent.com/YouneselBarnoussi/nova-difference/develop/LICENSE) for more information.
