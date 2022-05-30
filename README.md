## Project Scope

A customer approached us to build a web blogging platform.

The homepage will show all the blog posts to everyone visiting the web. Any user will be able to register in the platform, login to a private area to see the posts he created and, if they want, create new ones. They won't be able to edit or delete them.

The blog posts will only contain a title, description and publication date. The users should be able to sort them by publication_date.

Also, the customer is using another blogging platform and she wants us to auto import the posts created there and add them to our new blogging platform, for that reason, she provided us the following REST api endpoint that returns the new posts ([https://sq1-api-test.herokuapp.com/posts](https://sq1-api-test.herokuapp.com/posts)). 

The posts from this feed should be saved under a designated, system-created user, 'admin'.

Our customer is a very popular blogger, who generates between 2 and 3 posts an hour. The site which powers the feed linked above is a very popular one (several million visitors a month), and we are expecting a similar level of traffic on our site. One of our goals is to minimise the strain put on our system during traffic peaks, while also minimising the strain we put on the feed server.

## Functional Requirements

- The App must have a homepage
- The App must have an auth (login, register) page
- The App must have a dashboard area
- The App must have two user types (admin, user/guest/reader)
- The App must be able to import external json resource
- Imported Resource must belong to admin
- App User must be able to register and login
- Registered user Must be able to create new post
- A user must not be able to update/delete a post
- Posts must be sortable by publication_date

## Non Functional Requirements

- Posts should be searchable
- Admin should be able to delete/update a post
- Application should be tested

## Software Nature
The app is going be a page monolith implimented but i do hope to make a Single Page Application using [Laravel](https://laravel.com/) [Inertia](https://inertiajs.com) package if i have the time to do that



## Testing
For simpicity i'm going to use the official [Laravel Dusk](https://laravel.com/docs/8.x/dusk) for end to end testing of the application.

## Installation
To install this app make sure your php version is ^8 and follow the steps bellow:

1. Clone the repository
    ```
    git clone repo
    ```
2. Rename ``` .env.example ``` to ``` .env ``` and set your prefered database setting within the file
3. Run ``` composer install ``` to install all the packages
4. Run ``` php artisan serve ``` to start your development server
5. Then you can now access you website from ``` http://localhost:8000 ```

## Importing Posts
to import post you will need to run 
```
php artisan post:import
```
make sure you have a good internet connection before you do this

