## Quran Api Indonesian Complex

Quran Api Indonesian Complex is an open-source project that provides an API for accessing Indonesian translations of the Quran. It is built using the Laravel framework and utilizes MySQL and Redis as its data storage and caching solutions. The project retrieves Quranic data from the quran.com website.

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

### Features

-   Access Indonesian translations of the Quran.
-   Retrieve information about individual surahs.
-   Get specific ayahs (verses) by surah and verse numbers.
-   Perform text-based search within the Quranic text and translations.

### Technologies Used

Laravel: A powerful PHP framework for web application development.
MySQL: A relational database management system used for storing Quranic data and translations.
Redis: An in-memory data structure store used for caching frequently accessed data.
quran.com: The data source for retrieving Quranic data.

### Getting Started

To get started with the Quran Api Indonesian Complex project, follow these steps:

1. Clone the repository:

```
git clone https://github.com/your-username/quran-api-indonesian-complex.git
```

2. Install the project dependencies using Composer:

```

cd quran-api-indonesian-complex
composer install

```

Configure the environment variables:

Rename the .env.example file to .env.
Modify the .env file and set your database and Redis connection details.
Generate an application key:
