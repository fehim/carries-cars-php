Installation
============

That sounds like a lot of work: `INSTALLATION`.
Don't worry, at Carries Cars we have tried to make on-boarding a pleasant experience.

Using Docker
------------

 1. Clone the repository to a directory of choice;
 2. Run `docker compose up -d`
 3. Install dependencies `docker exec cars-php composer install`
 4. Verify that you are able to run the tests:
    ```bash
        > docker exec cars-php ./vendor/bin/phpunit src
        PHPUnit 8.5.21 by Sebastian Bergmann and contributors.
    
        .........                                                           9 / 9 (100%)
    
        Time: 231 ms, Memory: 4.00 MB
    
        OK (9 tests, 9 assertions)    
    ```
 
Using PhpStorm
--------------

 1. Open the directory in **PHPStorm**;
 2. Open `composer.json` and install dependencies
 3. Right click on `src` and select "Run 'src (PHPUnit)'"
 4. Add a new remote interpreter from ... next to interpreter selection:
    ![Remote PHP](./public/img/1.png)
 5. Select the new remote interpreter, "Apply" and "Run"

Frequently Asked Questions
--------------------------

 * **Do I really _need_ to use an IDE?**
   The short answer is yes. This workshop is build around the idea that the IDE can do a lot of the heavy lifting for us 
   when we start refactoring. During the workshop I recommend that you always use the IDE to change names of variables, 
   types, etc. By having the IDE take care of that we allow our brains to focus on the domain. Do make sure you run the
   tests each time you have made a change. Also in that regard I recommend running tests from within the IDE. This will 
   make navigation to test failures a lot quicker.  
   
   Certainly there are people that have vim set-up in ways that it can do a crazy amount of 
   heavy lifting too but that requires an awful lot of work. Those set-ups tend to be highly personalized making them 
   less ideal for collaboration, because they require knowledge about the set-up.
 
 * **Do I really _need_ to run the test from within the IDE?**
   In my experience it is easier to navigate to the failing line of (test) code when you run the tests from within your 
   IDE. Take this workshop as an opportunity to experience a different way of working. It also allows you to easily run 
   a single test instead of the whole suite. Yes, I know, you can do that from the command line too but the barrier will
   always be slightly higher than with a simple button next to the test itself. 

 * **It's not working?! Help!**
   Please open an issue with a clear description:
    - Which steps you took
    - What the expected results were
    - What you got in stead
   Thank you for you help in improving this experience for those that will follow in your footsteps :-)
