# Fakerino
Fakerino is a fake data generator framework fully extensible.

[![Latest Stable Version](https://poser.pugx.org/fakerino/fakerino/v/stable.svg)](https://packagist.org/packages/fakerino/fakerino)
[![Latest Unstable Version](https://poser.pugx.org/fakerino/fakerino/v/unstable.svg)](https://packagist.org/packages/fakerino/fakerino)
[![Travis Ci](https://travis-ci.org/niklongstone/Fakerino.svg?branch=master)](https://travis-ci.org/niklongstone/Fakerino)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6/mini.png)](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6)
[![Codacy Badge](https://www.codacy.com/project/badge/ff6ba56b25fe4d6486a0c6f86e55d172)](https://www.codacy.com/public/niklongstone/Fakerino)
[![Code Climate](https://codeclimate.com/github/niklongstone/Fakerino/badges/gpa.svg)](https://codeclimate.com/github/niklongstone/Fakerino)
[![Quality Score](https://img.shields.io/scrutinizer/g/niklongstone/Fakerino.svg?style=flat-square)](https://scrutinizer-ci.com/g/niklongstone/Fakerino)

[![License](https://poser.pugx.org/fakerino/fakerino/license.svg)](https://packagist.org/packages/fakerino/fakerino)

###Main features
Fakerino can:
* Fakes single data (e.g. name, surname, integer, text, ...).
* Fakes complex data (e.g. person: name, surname, hobby, country, ... ).
* Fakes data multiple times.
* Fakes a database table row/s automatically.
* Fakes a string or file template automatically (e.g. Hello Mr {{ surname }})
* Fakes a PHP Object.
* Supports JSON, array and string output.
 
For more information about installation, functions, support, contribution, or other,
please read the __[Fakerino wiki](https://github.com/niklongstone/Fakerino/wiki)__.

### Installation
Use [Composer](https://getcomposer.org/download/) to manage the dependencies of your project.
#### Inside your project
```sh
composer require fakerino/fakerino
cd vendor/fakerino/fakerino
build/ods
```
#### Like a stand-alone project with 
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
echo $fakerino->fake('nameMale')->num(3); //Bob Jack Rick
echo $fakerino->fake(array('nameMale', 'Surname'))->num(3)->toJson(); //[["Simon","Rodgers"],["Dean","Smith"],["Anthony","Bauman"]]

//with configuration
$fakerino = Fakerino::create('./conf.php');
print_r($fakerino->fake('fake1')->toArray());
  /*
  Array(
   [0] => Arthur
   [1] => Doyle
  )
  */
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

* [Symfony Fakerino](https://github.com/niklongstone/symfony-fakerino) - Symfony Fakerino Bundle
* [Laravel Fakerino](https://github.com/niklongstone/laravel-fakerino) - Laravel Fakerino Package
