## Demo of Meilisearch app 

The app contains books dataset from https://www.kaggle.com/datasets/ishikajohari/best-books-10k-multi-genre-data

This Laravel app example can be used as a base template for own projects. In this app I show an example of
using meilisearch.

App launches on http://127.200.200.165:3000

App features:
- Project has front and back part
- Meliasearch as search engine
- Project structured in modules
- Basic auth (JWT auth) and register system
- Swagger (http://127.200.200.165/api/docs)
- Nuxt3
- Laravel 11
- Docker (php 8.3, PosgresSQL, Meliasearch, Mailhog)

How launch app
- for launch: make up (or ./vendor/bin/sail up)
- to run container bash: make bash (or ./vendor/bin/sail bash)
- install composer dependencies
- php artisan migrate
- php artisan db:seed (seed DB by 10000 books from dataset https://www.kaggle.com/datasets/ishikajohari/best-books-10k-multi-genre-data)
- in front folder run npm i and npm run dev
- you can change project IP in env (by default http://127.200.200.165/)

