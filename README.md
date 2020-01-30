# Craw Website

Created using Symfony 4. A basic console application which will scrape the following website url https://videx.comesconnected.com/ and return a JSON array of all the product options on the page.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

```
PhP 7.2.11 
Composer
```

### Installing

A step by step series of examples that tell you how to get a development env running

Say what the step will be

```
git clone https://github.com/shorif2000/crawl_website.git
cd crawl_website
composer install
```

Run following command to execute

```
php bin/console app:dom-crawler https://videx.comesconnected.com
```

Example json output

## Running the tests

Tests are run using phpunit

To run tests execute

```
phpunit
```

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
