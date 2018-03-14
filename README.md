# PHP-Swarmed

Loads docker secrets into PHP environment variables.

This is a PHP version of [go-swarmed](https://github.com/blaskovicz/go-swarmed). It was also inspired by [phpdotenv](https://github.com/vlucas/phpdotenv).

## Why?

Because most frameworks, e.g. Symfony and Laravel, expect configuration variables as environment variables. Docker correctly recommends not setting sensitive environment variables as other applications can read these and instead recommend [secrets](https://docs.docker.com/engine/swarm/secrets/). For ease of use this library lets you import these secrets files into environment variables to allow you to use them as you usually would.

## Installation

```
composer require ikelutra\php-swarmed
```

## Usage

It is fairly simple and will convert the filename of the secret into the uppercase version as the key e.g. `/run/secrets/my_simple_secret` to `MY_SIMPLE_SECRET`. The value is the is the contents of the file minus any trailing whitespace.

```
$swarmed = new IkeLutra\Swarmed\Swarmed;
$swarmed->load();
```

By default it won't overwrite existing variables, for example set at runtime or by the Dockerfile. If you would like to overwrite these use:

```
$swarmed = new IkeLutra\Swarmed\Swarmed;
$swarmed->overload();
```

## Testing

The tests use docker-compose. To run them simply do:

```
docker-compose up
```

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Make your changes
4. Run the tests, adding new ones for your own code if necessary (`docker-compose up`)
5. Commit your changes (`git commit -am 'Added some feature'`)
6. Push to the branch (`git push origin my-new-feature`)
7. Create new Pull Request
