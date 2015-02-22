<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Configuration\ConfigurationFile;

use Fakerino\Configuration\AbstractConfigurationFile;

/**
 * Class XmlConfigurationFile
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class XmlConfigurationFile extends AbstractConfigurationFile
{
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $xmlString = file_get_contents($this->getConfFilePath());
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
        $xml2array = $this->xml2array($xml);

        return array($xml->getName() => $xml2array);
    }

    /**
     * Convert an XML string in an array
     *
     * @param SimpleXMLElement  $xmlObject
     * @param array             $out
     *
     * @return array
     */
    private function xml2array($xmlObject, $out = [])
    {
        foreach ($xmlObject->attributes() as $attr => $val) {
            $out['@attributes'][$attr] = (string) $val;
        }
        $hasChilds = false;
        foreach ($xmlObject as $index => $node) {
            $hasChilds = true;
            $out[$index][] = $this->xml2array($node);
        }
        if (!$hasChilds && $val = (string) $xmlObject) {
             $out['@value'] = $val;
        }
        foreach ($out as $key => $vals) {
            if (is_array($vals)
                && count($vals) === 1
                && array_key_exists(0, $vals)) {
                $out[$key] = $vals[0];
            }
        }

        return $out;
    }
}
