Bitcoin Tools v0.1.2
====================
Small library used to work with Bitcoin. Currently only contains a single class which validates Bitcoin addresses.


Requirements
------------
* [PHP 5.5 or greater](https://php.net/downloads.php).


Quick Start
-----------

```php
<?php

$testnet = false;
$validator = new Headzoo\Bitcoin\Tools\Validator($testnet);
if ($validator->isValid("1Headz2mYtpBRo6KFaaUEtcm5Kce6BZRJM")) {
    echo "This livenet address is valid.";
} else {
    echo "This livenet address is not valid.";
}

$testnet = true;
$validator = new Headzoo\Bitcoin\Tools\Validator($testnet);
if ($validator->isValid("mibNyNV8UNGrW7ySMS4htmvAGkhC1vVmAe")) {
    echo "This testnet address is valid.";
} else {
    echo "This testnet address is not valid.";
}
```


Change Log
----------
##### v0.1.2 - 2014/03/25
* Renamed namespace `Headzoo\Bitcoin` to `Headzoo\Bitcoin\Tools`.

##### v0.1.1 - 2014/03/23
* Renamed the project to bitcoin-tools.

##### v0.1 - 2014/03/20
* Genesis import!


License
-------
This content is released under the MIT License. See the included LICENSE for more information.

I write code because I like writing code, and writing code is a reward in itself, but donations are always welcome.

Bitcoin: 1Headz2mYtpBRo6KFaaUEtcm5Kce6BZRJM  
Litecoin: LheadzBgTNAitxYxUTUTTQ3RT7zR5jnkfq