# Fakerino
Fakerino is a fake data generator fully extensible,
can generate from a simple random Name to a complex data structure pre configured, 
it supports multiple output format and different configurations.

For more information about installation, functions, support, contribution, or others,
please read the [Fakerino wiki].

[![Latest Stable Version](https://poser.pugx.org/fakerino/fakerino/v/stable.svg)](https://packagist.org/packages/fakerino/fakerino) [![Latest Unstable Version](https://poser.pugx.org/fakerino/fakerino/v/unstable.svg)](https://packagist.org/packages/fakerino/fakerino)  [![Travis Ci](https://travis-ci.org/niklongstone/Fakerino.svg?branch=master)](https://travis-ci.org/niklongstone/Fakerino)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6/mini.png)](https://insight.sensiolabs.com/projects/4e7de12a-8fc4-4626-a33d-3287a20f02f6)
[![Codacy Badge](https://www.codacy.com/project/badge/ff6ba56b25fe4d6486a0c6f86e55d172)](https://www.codacy.com/public/niklongstone/Fakerino) [![Code Climate](https://codeclimate.com/github/niklongstone/Fakerino/badges/gpa.svg)](https://codeclimate.com/github/niklongstone/Fakerino)

[![License](https://poser.pugx.org/fakerino/fakerino/license.svg)](https://packagist.org/packages/fakerino/fakerino)
### Quick start
```
$fakerino = Fakerino::create('./conf.php');
echo $fakerino->fake('fake1')->toJson(); //["Joe", "Donovan"]
echo $fakerino->fake('Name'); //Nick
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
    'fake1' => array('Name' => array('length' => 3), 'Surname' => null),
    'fake2' => array('Name' => array('length' => 6), 'Surname' => null)
);
```


[Fakerino wiki]:https://github.com/niklongstone/Fakerino/wiki
