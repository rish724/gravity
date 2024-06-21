## How to run this project

1. Take a pull of this repository into your local required PHP version sould be minimum 8.1
2. Get inside the project folder and Run composer install command to get all the libraries
3. Run php artisan serve command
4. In postman hit the api with the host provided by serve command with endpoint /api/diwaliOffer so for example complete url will be http://127.0.0.1:8000/api/diwaliOffer in POST request with json request params as 
{
    "rule":3,
    "input":[5, 5, 10, 20, 30, 40, 50, 50, 50, 60]
}
rule value can only be 1,2 or 3 you will get the desired output

