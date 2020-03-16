# icontroller-test

Test for icontroller, by Albert Casadessus

## Tech explanation
- I implemented the business logic using TDD approach as it's a very good use case for it.
- I used Symfony as you use it in your company and as I have worked with it for many years in the past and it provides me with the basic functionality for a web application.
- I used a League of PHP library to generate the CSV.
- I didn't spend a lot of time on the UI part as it was not clear how it should be. However, it provides all the functionality.
- I didn't move the logic from the controller (form + csv builder) as this is a test and it is not reusable.
- Business logic lives here:
https://github.com/llissssss/icontroller-test/blob/master/src/Service/ 
- Test of business logic lives here:
https://github.com/llissssss/icontroller-test/blob/master/src/tests/Service/ 
- The rest is following sf standards (controller, routes, templates)

## How to run?
- Install composer and the symfony CLI to run the server https://symfony.com/download
- Run composer install
- Run the server `symfony server:start`
- It will show you the page to start, where the UI lives.

## Business logic disclamer
It was not clear in the description whether when showing the month and the base due date and the bonus, if the bonus date should be the one for the month of salary (which in this case should be paid in february), or if since this would be for finance, it is about on when they have to make the payment for the previous month. 

I chose the 2nd one as the user being the finance department, makes sense for me. As an example, the user would see something like:

> January, 2019-01-31, 2019-01-15

Because when you are about to pay for january, you want to see dates for this month, not the future in my opinion.
