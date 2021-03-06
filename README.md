# BOILERPLATE
This is a PHP boilerplate for quick bootstrapping PHP applications.

## Contact
For any info or question please feel free to contact me:

- http://simonelippolis.com/
- http://twitter.com/simonelippolis

Or use the wonderful Github tools.
I really would love to know if you tried this code, and what your opinion about it is.

## How it works
The ./.htaccess file redirects every request to the main index.html.
It then includes all the required files and classes, checks the required url against the user-defined routes, and includes the defined file.
Using this boilerplate building different kind of PHP application is quick and easy: just use regex to define routes and create the corresponding files in ./core/sources for each route.

## Configuration
Open ./settings.php and edit where required. Connection to MySql is managed in the index.php file, you can use the $DBH object to run your queries.

## Requirements

- PHP 5.3+, PHP 7 (this is the only version of PHP tested at the moment)
- PHP configuration without safe_mode enabled
- MySql 5.1.73-1 (this is the only version of MySql tested at the moment - not required by the boilerplate itself)

## Installation
Copy everything to the public_html folder on your server (including ./.htaccess and ./core/.htaccess).
chmod 777 ./uploads and ./core/cache if needed.

## Routes
The $routes array contains the definition of valid routes for your application. The match is
```
array( _Regex_ route => _String_ source_file )
```
The routes already defined are just examples. Since the keys of the array are Regex patterns, you'll be able to define very complex routes with variables.

### Example
```
'/post\/[0-9]+\/[a-zA-Z0-9_\-]+(\/)?/' => 'posts/post.php'
```
will include ./core/sources/posts/post.php for any of the following requests:

```
/post/1/my-first-post
/post/2/my-second-post/
```
Querystrings are removed from the URL before any regex comparison is performed, this means that if the user asks something like
```
/post/1/my-first-post?from=Facebook_Campaign
```
the regex match will succeed, and the "from" variable will be accessible from the $_GET array.

## Running from command line
Certain functionalities (i.e. automated tasks added as cron jobs) perform better if executed from the command line. It is possible to initialise the entire working environment (classes, libraries, etc.) by running index.php from the command line. The first argument appended need to be the name of the file in `/core/sources` to be executed.

### Example
If you need a DB maintenance task to be executed every hour you can create a `/core/sources/dbmaintenance.php` with all the required code. Any custom class defined in `/core/classes` or imported using composer, as well as all the configuration constants and variables defined in `/settings.php` will be available to that file when launched with the command:

`$ php /path_to_your_web_root/index.php dbmaintenance`

## Sources
Your application's source file must be stored in the ./core/sources directory or in any subdirectory created under it.
The index.php file will match the requested URL with the routes defined in the settings file, and will look for the corresponding file

## Adding external libraries (i.e. Smarty)
You can now use [Composer](https://getcomposer.org). Be sure to set Composer to save required classes and module to the `/vendor folder`. Should you need to put it in a different location, be sure to change the M_COMPOSER constant in settings.php

_While this upgrade is backward-compatible, my advice is to start using composer when you import third-party libraries, and keep your `./core/libraries` folder clean._

The following method to add third-party libraries is deprecated and must be used only for libraries not available on Composer.

>> Within `./core/libraries` create a folder with the name of your library. Within this folder upload all the required files and folder. The `index.php` will automatically include any `*.lib.php` file found in the first child folder of `./core/libraries`.
>> 
>> ### Example
>> You want to add Smarty as a library for your project, this is the folder structure:
>> ```
>> - /
>> - [D] core
>> -- [D] cache
>> -- [D] classes
>> -- [D] libraries
>> --- [D] Smarty
>> ---- (...) various smarty file and folders
>> ---- Smarty.lib.php (<-- this file will be automatically included)
>> -- [D] sources
>> - [D] uploads
>> - .htaccess
>> - index.php
>> - settings.php
>> ```

## Adding custom classes
Add to ./core/classes any custom class you wrote for your application. Create a folder for any new class, any *.class.php within it will be automatically included by index.php

### Example
You wrote a class to manage Users, this is the folder structure:
```
- /
- [D] core
-- [D] cache
-- [D] classes
--- [D] Users
---- Users.class.php (<-- this file will be automatically included)
-- [D] libraries
-- [D] sources
- [D] uploads
- .htaccess
- index.php
- settings.php
```

## Debugging

`error_reporting(0);` is the default configuration, this means no errors are shown. If you need to debug your app, just create an empty `/.debug` file, this will set `error_reporting(E_ALL);`. Once finished debugging, just delete the file to get back to your normal operations.

## License

The MIT License (MIT)

Copyright (c) 2015 Simone Lippolis

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Change Log

### Nov, 2017
Now you can run your boilerplated-scripts from command line.
Improved MySql connection functionalities.

### Sept, 2016
Added support for Composer.

### Oct, 2015
Added check if required folders are existent or not, in order to avoid triggering errors.
Added /.htaccess to the repo.

### Jun, 2015
Minor bug fixings and documentation changes.

### Jun, 2015
First commit.
