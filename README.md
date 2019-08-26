# oc-trait-scope-frontend

OctoberCMS Frontend scope trait

## Installation

Package requires **PHP 7.2+** and works with **OctoberCMS**.

Require the package in your `composer.json`:

```
    "require": {
        ...
        "alvaro-canepa/oc-trait-scope-frontend": "~1.0",
    },
```

## Usage example

```php
    class myModel extend Model {
        use PlanetaDelEste\Traits\ScopeFrontendTrait;

        ...
    }

    /*
     * @var array $sort 'column' key must be the model column to sort
     *                  'direction', accepted values: "asc", "desc"
     */
    $sort = [
                'column'    => get('sort.column'),
                'direction' => get('sort.direction')
            ];
    /*
     * @var array $filters key => value format, where key was used as column name, 
     *                     and value as search term.
     */
    $filters = get('filters');

    $collection = myModel::frontend($filters, $sort)->get();
```