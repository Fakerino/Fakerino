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
    private $input = null;
    private $help = false;
    private $confFile = null;
    private $json = false;
    private $num = null;
    private $locale = null;

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
        $jsonIndex = array_search('-j', $this->input);
        if ($jsonIndex !== false) {
            unset($this->input[$jsonIndex]);
            $this->json = true;
        }
        $numIndex = array_search('-n', $this->input);
        if ($numIndex !== false) {
            unset($this->input[$numIndex]);
            $this->num = $this->input[$numIndex+1];
            unset($this->input[$numIndex+1]);
        }
        $confIndex = array_search('-c', $this->input);
        if ($confIndex !== false) {
            unset($this->input[$confIndex]);
            $this->confFile = $this->input[$confIndex+1];
            unset($this->input[$confIndex+1]);
        }
        $localeIndex = array_search('-l', $this->input);
        if ($localeIndex !== false) {
            unset($this->input[$localeIndex]);
            $this->locale = $this->input[$localeIndex+1];
            unset($this->input[$localeIndex+1]);
        }
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
        if ($this->confFile === null) {
            if ($this->locale === null) {
                $fakerino = Fakerino::create();
            } else {
                $conf = array();
                $conf['locale'] = $this->locale;
                $fakerino = Fakerino::create($conf);
            }
        } else {
            $fakerino = Fakerino::create($this->confFile);
        }
        $result = $fakerino->fake($this->input);
        if ($this->num) {
            $result = $fakerino->num($this->num);
        }
        if ($this->json) {
            $result = $fakerino->toJson() . PHP_EOL;
        }

        return $result;
    }

    private function showHelp()
    {
        $helper = 'Usage:' . PHP_EOL;
        $helper .= ' app/fake <fake data name> [-j] [-n <integer>] [-c <config file path>]' .PHP_EOL . PHP_EOL;
        $helper .= 'Options:' . PHP_EOL;
        $helper .= str_pad(' -j', 15) . 'Returns JSON format (default string)' . PHP_EOL;
        $helper .= str_pad(' -n <num>', 15) . 'Returns <num> times the result' . PHP_EOL;
        $helper .= str_pad(' -l', 15) . 'Changes the locale settings (default en-GB)' . PHP_EOL;
        $helper .= str_pad(' -c <conf>', 15) . 'Uses the <conf> file for generating data (override the locale -l if set)' . PHP_EOL;
        $helper .= str_pad(' -h', 15) . 'Displays this help' . PHP_EOL;

        return $helper;
    }
}