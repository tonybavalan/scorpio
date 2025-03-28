<p align="center"><a href="https://scorpio.tonythedevops.ml" target="_blank"><img src="https://raw.githubusercontent.com/tonybavalan/scorpio/main/public/img/scorpio.svg" width="400"></a></p>

## About Scorpio

Scorpio is a web application with expressive, elegant and simple project that helps to assign a cab driver to a customer on demand. We believe development must be an enjoyable and creative experience to be truly fulfilling. Scorpio takes the pain out of development by easing common tasks used in many uberisation projects, such as:

- Auto assigning of drivers to trips.
- Creating and maintaining trip records of customers.
- Multiple User Authentication using [sanctum](https://laravel.com/docs/session) and [rate limiting](https://laravel.com/docs/cache) through [caching].
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).

Scorpio is accessible, powerful, and provides tools required for large, robust applications.

## Prerequisites

- PHP 8.1
- Composer
- TomTom Maps APIKEY (Include it in .env file. Please refer .env.example file)

## Developer Documentation

People can start testing the API's of scorpio by adding the /docs URI (ex: http://scorpio.test/docs) in their browser. The API documentations were created using [Scribe](https://github.com/knuckleswtf/scribe) by [Knuckles](https://github.com/knuckleswtf). Start generating the document by running the below command:
 - composer install
 - php artisan key:generate
 - php artisan migrate 
 - php artisan scribe:generate

 The API documentation will be available in the route {APP_URL}/docs

## TomTom Maps

It started with a simple idea: Make digital navigation accessible for everyone. Today, TomTom is the leading independent geolocation technology specialist. Our decades of driver insights go into everything we do – maps for automated driving, navigation software for top car brands, maps APIs for leading tech companies and traffic data for all. Checkout [TomTom Maps](https://www.tomtom.com/en_us/).

## Made out of Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Security Vulnerabilities

If you discover a security vulnerability within Scorpio, please send an e-mail to Tony Bavalan via [tonybavalan.a@gmail.com](mailto:tonybavalan@projectscorpio.ml). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
