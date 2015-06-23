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

- PHP 5.3.3-7 (this is the only version of PHP tested at the moment)
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


## Sources
Your application's source file must be stored in the ./core/sources directory or in any subdirectory created under it.
The index.php file will match the requested URL with the routes defined in the settings file, and will look for the corresponding file

## Adding external libraries (i.e. Smarty)
Within ./core/libraries create a folder with the name of your library. Within this folder upload all the required files and folder. The index.php will automatically include any *.lib.php file found in the first child folder of ./core/libraries.

### Example
You want to add Smarty as a library for your project, this is the folder structure:
```
- /
- [D] core
-- [D] cache
-- [D] classes
-- [D] libraries
--- [D] Smarty
---- (...) various smarty file and folders
---- Smarty.lib.php (<-- this file will be automatically included)
-- [D] sources
- [D] uploads
- .htaccess
- index.php
- settings.php
```
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

### Jun 2015
Minor bug fixings and documentation changes.

### Jun, 2015
First commit.
