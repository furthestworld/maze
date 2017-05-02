# About Maze #

[![Build Status](https://travis-ci.org/edoger/maze.svg?branch=master)](https://travis-ci.org/edoger/maze)
[![Latest Stable Version](https://poser.pugx.org/edoger/maze/v/stable)](https://packagist.org/packages/edoger/maze)
[![Total Downloads](https://poser.pugx.org/edoger/maze/downloads)](https://packagist.org/packages/edoger/maze)
[![Latest Unstable Version](https://poser.pugx.org/edoger/maze/v/unstable)](https://packagist.org/packages/edoger/maze)
[![License](https://poser.pugx.org/edoger/maze/license)](https://packagist.org/packages/edoger/maze)

Maze is a PHP configuration file manager.

# Installation #

```sh
composer require edoger/maze
```

# Example #

```php
<?php
use Maze\Maze;

// Create Maze configuration file manager instanse.
$maze = new Maze("Your/configuration/file/root/directory");

// Load: Your/configuration/file/root/directory/maze.conf.php
$items = $maze->load('maze');

$items->exists('key');       // Check whether the configuration item exists.
$items->get('key');          // Get a configuration item value.
$items->all();               // Get all configuration item values.
$items->set('key', 'value'); // Add or update a configuration item.
$items->forget('key');       // Forget a configuration item.
$items->merge($items);       // Merge all configuration items from another items instance.
?>
```

# License #

[Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0)