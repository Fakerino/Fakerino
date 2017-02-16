# Fakerino

[![Join the chat at https://gitter.im/Fakerino/Fakerino](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/Fakerino/Fakerino?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
Fakerino is a fake data generator framework fully extensible.

[![Latest Stable Version](https://poser.pugx.org/fakerino/fakerino/v/stable.svg)](https://packagist.org/packages/fakerino/fakerino)
[![Latest Unstable Version](https://poser.pugx.org/fakerino/fakerino/v/unstable.svg)](https://packagist.org/packages/fakerino/fakerino)
[![Travis Ci](https://travis-ci.org/Fakerino/Fakerino.svg?branch=master)](https://travis-ci.org/Fakerino/Fakerino)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6/mini.png)](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6)
[![Code Climate](https://codeclimate.com/github/Fakerino/Fakerino/badges/gpa.svg)](https://codeclimate.com/github/Fakerino/Fakerino)
[![Quality Score](https://img.shields.io/scrutinizer/g/Fakerino/Fakerino.svg?style=flat-square)](https://scrutinizer-ci.com/g/Fakerino/Fakerino)
[![Code Coverage](https://scrutinizer-ci.com/g/Fakerino/Fakerino/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Fakerino/Fakerino/?branch=master)

[![License](https://poser.pugx.org/fakerino/fakerino/license.svg)](https://packagist.org/packages/fakerino/fakerino)

[![Join the chat at https://gitter.im/Fakerino/Fakerino](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/Fakerino/Fakerino?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)  

###Main features

* Fake __complex data__ (e.g. person: name, surname, hobby, country, ... ).
* Fake __single data__ (e.g. name, surname, integer, text, ...).
* Fake data in __different languages__.
* Fake __regular expression__ data (e.g. url => '`/www\.\w+\.com/`').
* Fake data multiple times.
* Fake a __database__ table row/s with one line of code.
* Fake a __Twig__ string or file automatically (e.g. Hello Mr {{ surname }})
* Fake a PHP __object/entity__ in one line of code (fills public properties and setters with fake data).
* Support __JSON__, __array__ and string output.
* Support array, __Yaml__, __XML__, __PHP__, __Txt__ and __Ini__ configurations.
* Fake from __command line__ interface.

For more information about installation, features, support, contribution, or other,
please read the __[Fakerino docs](http://www.fakerino.io)__.

### Installation
Use [Composer](https://getcomposer.org/download/) to manage the dependencies of your project.
####In your project folder run:
```sh
composer require fakerino/fakerino='~0.8'
vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data
```
#### Like a stand-alone project run:
```sh
composer create-project fakerino/fakerino fakerino
```

### Quick start
```PHP
<?php
require ('vendor/autoload.php'); 
use Fakerino\Fakerino;

$fakerino = Fakerino::create();
echo $fakerino->fake('Surname')->toJson(); //["Donovan"]
echo $fakerino->fake('nameFemale'); //Alice
echo $fakerino->fake('/www\.\w+\.com/'); //www.nikdjap.com
echo $fakerino->fake('nameMale')->num(3); //Bob Jack Rick
echo $fakerino->fake(array('nameMale', 'Surname'))->num(3)->toJson(); //[["Simon","Rodgers"],["Dean","Smith"],["Anthony","Bauman"]]
```

With a [configuration](http://fakerino.github.io/define-fake-data-groups.html) you can __combine fake data__, or declare your __customs__.
```PHP
$fakerino = Fakerino::create('./conf.php');
print_r($fakerino->fake('fakeChat')->toArray());
/* 
Array(
    [0] => Array
        (
            [0] => Array
                (
                    [0] => Fake Rino <fakerino@fake.com>
                    [1] => 01 Jan 2015 14:14:42
                    [2] => Hi gentle developer!
                )
            [1] => Array
                (
                    [0] => Anonym Dev <anon@dev.com>
                    [1] => 01 Jan 2015 14:17:42
                    [2] => Hi Fakerino!
                )
        )
)*/
```

#### With Command line
`app/fake -h` //for help  
`app/fake namemale surname` //Travis Baldwin  
`app/fake surname -j` //["Brooks"]  
`app/fake nameMale -n 2` //Nick Andy  
`app/fake country -c path/config.ini` //uses a config file  
`app/fake surname -l de-DE` //Schleßinger  
`app/fake -s 'Hello Mrs {{namefemale}} {{surname}}' -l de-DE` //Hello Mrs Seeliger Ceylin  
`app/fake -t tableName -c path/confix.xml -n 10` //Inserts 10 fake rows into tableName  

#### Third parties

* [Symfony Fakerino](https://github.com/Fakerino/symfony-fakerino) - Symfony Fakerino Bundle
* [Laravel Fakerino](https://github.com/Fakerino/laravel-fakerino) - Laravel Fakerino Package
* [Nette Fakerino](https://github.com/Fakerino/nette-fakerino) - Nette Fakerino Service
