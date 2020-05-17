# About Artikels

Artikels is a simple web application built with Laravel backend and a Vue frontend which allows used to Add, Read, Update and delete articles on the website. This application shows basics of CRUD functionalities using Laravel and Vue.

## How to use

Artikels is easy to use
Follow the below steps to get started using Artikels on your computer

- [Download or Fork the repository](https://github.com/mann170296/Artikels.git)
- After downloading, you need to rename your `.env.example` file to `.env` and setup your database accordingly in there. You can use the Laravel Guide to get help with Laravel files if you are new.
- Open your terminal window and navigate to the place you downloaded your files and type `npm install` to download the required packages including bootstrap and vue
- On terminal, then run `php artisan migrate`, make sure you have a database set before running the migrate command else you will get an error
- After migration, you can run the optional command on the terminal to get dummy data inside your database table for testing purposes. Run `php artisan db:seed`
- The setup should be complete, you can now run `npm run watch` and use your application at `localhost:8080`

## Please help me update the README file if you think i forgot something important during the setup. 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
