# MOBV Server

## Installation

 - clone repository

    ```
    $ git clone https://github.com/miso93/mobv-server
    ```

 - install required packages using composer
    - development
    
        ```
        $ composer install --dev --no-suggest -o
        ```
    - production
    
        ```
        $ composer install --no-dev --no-suggest -o
        ```

 - edit `.env` file

 - run migrations
    ```
    $ php artisan migrate
    ```

>**Note**: To test if everything works try running `$ curl -I http://{YOUR SERVER}/api/v1/places` you should get response 200. 