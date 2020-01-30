# Craw Website

Created using Symfony 4. A basic console application which will scrape the following website url https://videx.comesconnected.com/ and return a JSON array of all the product options on the page.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

```
PhP 7.2.11 
Composer
```

### Installing


```
git clone https://github.com/shorif2000/crawl_website.git
cd crawl_website
composer install
```

Run following command to execute

```
php bin/console app:dom-crawler https://videx.comesconnected.com
```


## Running the tests

Tests are run using phpunit

To run tests execute

```
./vendor/bin/simple-phpunit tests/
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
