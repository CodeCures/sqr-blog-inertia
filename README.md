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
- Imported Resource must belong to admin
- App User must be able to register and login
- Registered user Must be able to create new post
- A user must not be able to update/delete a post


## Non Functional Requirements

- Posts should be searchable
- Admin should be able to delete/update a post
- Posts must be sortable by publication_date
- The App must be able to import external json resource
- Application should be tested

## Note
I am going to add an extra column state to post table. This is to determine the state (draft, published, archived) of the object and
allow only the published posts on the home page

## Software Nature
The app is going be a monolith but of course it can be implimented as an SPA using any of the front end frameworks, wich i may not have the time to go into.

Enable the QueryCachable trait in post model only if you wish to cache the result of each query.

## Installation
To install this app make sure your php version is ^8 and follow the steps bellow:

1. Clone the repository
    ```
    git clone https://github.com/CodeCures/sqr-blog.git
    ```
2. Rename ``` .env.example ``` to ``` .env ``` and set your prefered database setting within the file
3. Run ``` composer install ``` to install all the packages
4. Run ``` php artisan migrate --seed ``` 
5. Run ``` php artisan serve ``` to start your development server
6. Then you can now access you website from ``` http://localhost:8000 ``` or visit ``` http://blog.test ``` depending on your configurations
7. admin email is ``` admin@blog.test ``` and password is ``` pass123 ```

## Importing Posts
To import post you will need to run 
```
php artisan post:import
```
make sure you have a good internet connection before you do this.

Post importation is also scheduled to run every 30 Minutes to check for what has changed and import it. you can run ``` php artisan schedule:list ``` to see the list of scheduled tasks

## Testing
For simpicity i'm going to use the official [Laravel Dusk](https://laravel.com/docs/8.x/dusk) for end to end testing of the application. 

Before running the tests please make sure to disable the ``` QueryCacheable ``` trait in the post model as this may cause issues during the tests. I have two tests for the app ``` AuthTest ``` and ``` PostTest ``` you may want to run them separated to save time.

