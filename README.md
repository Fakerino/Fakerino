# Fakerino
Fakerino is a fake data generator fully extensible,
can generate from a simple random Name to a complex data structure, 
it supports multiple output format and configurations.

For more information about installation, functions, support, contribution, or other,
please read the [Fakerino wiki].

[![Latest Stable Version](https://poser.pugx.org/fakerino/fakerino/v/stable.svg)](https://packagist.org/packages/fakerino/fakerino) [![Latest Unstable Version](https://poser.pugx.org/fakerino/fakerino/v/unstable.svg)](https://packagist.org/packages/fakerino/fakerino)  [![Travis Ci](https://travis-ci.org/niklongstone/Fakerino.svg?branch=master)](https://travis-ci.org/niklongstone/Fakerino)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6/mini.png)](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6)
[![Codacy Badge](https://www.codacy.com/project/badge/ff6ba56b25fe4d6486a0c6f86e55d172)](https://www.codacy.com/public/niklongstone/Fakerino)
[![Code Climate](https://codeclimate.com/github/niklongstone/Fakerino/badges/gpa.svg)](https://codeclimate.com/github/niklongstone/Fakerino)
[![Test Coverage](https://codeclimate.com/github/niklongstone/Fakerino/badges/coverage.svg)](https://codeclimate.com/github/niklongstone/Fakerino)


[![License](https://poser.pugx.org/fakerino/fakerino/license.svg)](https://packagist.org/packages/fakerino/fakerino)
### Quick start
```
<?php
include ('../Fakerino/vendor/autoload.php');
use Fakerino\Fakerino;

$fakerino = Fakerino::create();
echo $fakerino->fake('Surname')->toJson(); //["Donovan"]
echo $fakerino->fake('FemaleName'); //Alice

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

```
//conf.php
<?php
$conf['fake'] = array(
    'fake1' => array('MaleName', 'Surname' => null),
    'fake2' => array('FemaleName', 'Surname' => null)
);
```


[Fakerino wiki]:https://github.com/niklongstone/Fakerino/wiki
