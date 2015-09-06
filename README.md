# KleijnWeb Symfony Swagger Microservice Edition 

Symfony edition for "interface first" microservices that's as lean and mean as it is unofficial.  

## Quick Start

1. `composer install`
2. Rename `.env.dist` to `.env`
3. Confirm all is good to start screwing things up: `phpunit -c app` 
4. Replace `web/petstore.yml` with your own Swagger
5. Update that ref in `routing.yml`
6. Start hacking away at the pet store :)

__Note:__ To change the root namespace from Acme to your own, update composer.json autoload config and `install`.

## Packages

This edition uses [kleijnweb/swagger-bundle](https://github.com/kleijnweb/swagger-bundle) to integrate routing and input validation from Swagger into Symfony. On top of its (very modest) dependencies, this edition only adds [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv). Monolog is added as the logger, as SwaggerBundle will work with any PSR logger and depends only on the interface package.

For devs, it adds convenience methods for functional testing of your API, which includes validation of your responses against your Swagger definition thanks to [SwaggerAssertions](https://github.com/Maks3w/SwaggerAssertions).

## License

MIT