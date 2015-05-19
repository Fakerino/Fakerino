<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Console;

use Fakerino\Fakerino;

/**
 * Class FakeConsole,
 * provides functionalities for the CLI.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakeConsole
{
    private $input;
    private $help;
    private $confFile;
    private $json;
    private $num;
    private $locale;
    private $table;
    private $templateSource;

    /**
     * Constructor.
     *
     * @param array $input
     */
    public function __construct($input)
    {
        $this->input = $input;
        unset($this->input[0]);
        $helpIndex = array_search('-h', $this->input);
        if ($helpIndex !== false) {
            $this->help = true;

            return;
        }
        $this->json = $this->getParam('-j');
        $this->num = $this->getParam('-n', true);
        $this->confFile = $this->getParam('-c', true);
        $this->locale = $this->getParam('-l', true);
        $this->help = $this->getParam('-h');
        $this->table = $this->getParam('-t', true);
        $this->templateSource = $this->getParam('-s', true);
    }

    private function getParam($flag, $hasValue = false)
    {
        $flagValue = false;
        $flagIndex = array_search($flag, $this->input);
        if ($flagIndex !== false) {
            $flagValue = true;
            unset($this->input[$flagIndex]);
            if ($hasValue) {
                $flagValue = $this->input[$flagIndex+1];
                unset($this->input[$flagIndex+1]);
            }
        }

        return $flagValue;
    }

    /**
     * Runs the command.
     *
     * @return mixed
     */
    public function run()
    {
        if ($this->help) {

            return $this->showHelp();
        }
        if ($this->confFile) {
            $fakerino = Fakerino::create($this->confFile);
        } else {
            $fakerino = Fakerino::create();
            if ($this->locale) {
                $conf = array();
                $conf['locale'] = $this->locale;
                $fakerino = Fakerino::create($conf);
            }
        }
        if (!$this->num) {
            $this->num = 1;
        }
        if ($this->table) {
            $fakerino->num($this->num)->fakeTable($this->table);

            return;
        }
        if ($this->templateSource) {
            return $fakerino->num($this->num)->fakeTemplate($this->templateSource);
        }
        $fakerino = $fakerino->fake($this->input)->num($this->num);

        if ($this->json) {
            $result = $fakerino->toJson() . PHP_EOL;
        } else {
            $result = (string) $fakerino;
        }

        return $result;
    }

    private function showHelp()
    {
        $helper = 'Usage:' . PHP_EOL;
        $helper .= ' app/fake <fake data name> [-j] [-n <integer>] [-c <config file path>]' .PHP_EOL . PHP_EOL;
        $helper .= 'Options:' . PHP_EOL;
        $helper .= str_pad(' -j', 20) . 'Returns JSON format (default string)' . PHP_EOL;
        $helper .= str_pad(' -n <num>', 20) . 'Returns <num> times the result' . PHP_EOL;
        $helper .= str_pad(' -l', 20) . 'Changes the locale settings (default en-GB)' . PHP_EOL;
        $helper .= str_pad(' -c <conf>', 20) . 'Uses the <conf> file for generating data (override the locale -l if set)' . PHP_EOL;
        $helper .= str_pad(' -t <table>', 20) . 'Fills fake data in the specified <table> (requires a config file)' . PHP_EOL;
        $helper .= str_pad(' -s <file|string>', 20) . 'Returns a fake data from specified <file> or <string> template source' . PHP_EOL;
        $helper .= str_pad(' -h', 20) . 'Displays this help' . PHP_EOL;

        return $helper;
    }
}