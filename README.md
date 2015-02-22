# Fakerino
Fake data generator

[![Latest Stable Version](https://poser.pugx.org/fakerino/fakerino/v/stable.svg)](https://packagist.org/packages/fakerino/fakerino) [![Latest Unstable Version](https://poser.pugx.org/fakerino/fakerino/v/unstable.svg)](https://packagist.org/packages/fakerino/fakerino) [![License](https://poser.pugx.org/fakerino/fakerino/license.svg)](https://packagist.org/packages/fakerino/fakerino) [![Travis Ci](https://travis-ci.org/niklongstone/Fakerino.svg?branch=master)](https://travis-ci.org/niklongstone/Fakerino.svg?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6/mini.png)](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6)

### Basic Usage
```
include 'Fakerino/vendor/autoload.php';
use Fakerino\Fakerino;

$fakerino = Fakerino::create('./conf.php');
echo $fakerino->fake('fake1')->toJson();
//["Joe", "Donovan"]
echo $fakerino->fake('Name');
//Nick
print_r($fakerino->fake('fake2')->toArray());
/*
Array(
 [0] => Arthur
 [1] => Doyle
)
*/
```

```
//conf.php
<?php
$conf['fake'] = array(
    'fake1' => array(
        'Name' => array('length' => 3),
        'Surname' => null
    ),
    'fake2' => array(
        'Name' => array('length' => 6),
        'Surname' => null
    )
);
```

## Roadmap of Fakerino Feb/Mar 2015
 - add fakefile support
 - add support for other configuration files
 - write examples and more documentation
 - provide stable release
