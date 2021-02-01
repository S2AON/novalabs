<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cors','json.response']], function () {

    Route::prefix('auth')->group
    (
        function ()
        {
            /*********************
            **** Auth Routes ****
            *********************/
            //login registered user
            Route::post('/login', 'Auth\ApiAuthController@login');

            //User Registration
            Route::post('/register', 'Auth\ApiAuthController@register');

            //Authentication protected routes
            Route::middleware('auth:api')->group
            (
                function ()
                {
                    //Logout authenticated user
                    Route::post('/logout', 'Auth\ApiAuthController@logout');

                }
            );

        }

    );

    //Authentication protected routes
    Route::middleware('auth:api')->group
    (
        function ()
        {
            Route::prefix('profile')->group
            (
                function()
                {
                    //Show the user profile information
                    Route::get('/', 'UserController@index');

                }
            );

            Route::prefix('cars')->group
            (
                function()
                {
                    //Show the list of available cars to rent
                    Route::get('/', 'CarController@index');

                    //Show details about an specific car
                    Route::get('/{car}', 'CarController@show');

                }
            );

            Route::prefix('order')->group
            (
                function()
                {
                    //Show or list the rental history of the user
                    Route::get('/', 'RentalOrderController@index');

                    //Show details about an specific order
                    Route::get('/{code}', 'RentalOrderController@show');

                    //Create a new order
                    Route::post('/new', 'RentalOrderController@store');

                }
            );

        }
    );
});
