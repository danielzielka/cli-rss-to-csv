# Installation

To download the tool, just simply type in command line:

```
git clone https://github.com/danielzielka/cli-rss-to-csv
```

Then, you have to install composer dependencies

```
composer install
```

# List of commands

Creates [PATH].csv file from given RSS [URL]

```
php src/console.php csv:simple [URL] [PATH]
```

Adds data from given RRS [URL] to an existing file [PATH].csv.
If the file doesn't exist,it creates a new one.

```
php src/console.php csv:extended [URL] [PATH]
```

Shows a list of all commands

```
php src/console.php list
```

Shows information about command

```
php src/console.php command -h
```

# Development

## Unit tests

To run unit tests, just simply type following command in terminal:

```
phpunit
```
