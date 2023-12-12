# Bayt.com Automation Testing
This project contains a set of automated test cases designed to validate various functionalities on [Bayt.com](https://www.bayt.com/en/egypt/),
a popular online job platform.

## Features:
- Apply for a job without logging in
- Verify email validation functionality
- Login and delete account
- Apply for a job with mobile view

## System Requirements:
- PHP v8.3
- Composer
- Chome driver matching your Chrome Browser version

## Running the test:
1. Add the Chrome driver loction to the `BaytTest.php` file at setUp function
1. Open a terminal and navigate to the project directory.
2. Run the following command to install the project dependencies `composer install`
3. Run the following commond to execute all test case `./vendor/bin/phpunit ./src/test/BaytTest.php`

## Additional Notes
- Please refer to the individual test files for more specific information about each test case.
- During test execution, screenshots are captured and saved. You can find them in the following directory `src/output/`