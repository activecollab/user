<?php

namespace ActiveCollab\User\UserInterface;

use ActiveCollab\User\UserInterface;
use HumanNameParser_Parser as HumanNameParser;

/**
 * @package ActiveCollab\User\UserInterface
 */
trait ImplementationUsingFullName
{
    use FormatNameImplementation;

    /**
     * Return first name of this user
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->getFullNameBit('first');
    }

    /**
     * Return first name of this user
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->getFullNameBit('last');
    }

    /**
     * @var array|null
     */
    private $full_name_bits;

    /**
     * Return first name bit
     *
     * @param  string $bit
     * @return string
     */
    private function getFullNameBit($bit)
    {
        if (empty($this->full_name_bits)) {
            $full_name = $this->getFullName();

            if (empty($full_name)) {
                $exploded_full_name = explode(' ', str_replace(['.', '-', '_'], [' ', ' ', ' '], substr($this->getEmail(), 0, strpos($this->getEmail(), '@'))));

                if (count($exploded_full_name) === 1) {
                    $this->full_name_bits = ['first' => mb_strtoupper(mb_substr($exploded_full_name[0], 0, 1)) . mb_substr($exploded_full_name[0], 1)];
                } else {
                    $full_name = [];

                    foreach ($exploded_full_name as $k) {
                        $full_name[] = mb_strtoupper(mb_substr($k, 0, 1)) . mb_substr($k, 1);
                    }

                    $this->full_name_bits = (new HumanNameParser(implode(' ', $full_name)))->getArray();
                }
            } else {
                $this->full_name_bits = (new HumanNameParser($full_name))->getArray();
            }
        }

        return empty($this->full_name_bits[$bit]) ? '' : $this->full_name_bits[$bit];
    }

    /**
     * Return full name of this user
     *
     * @return string
     */
    abstract public function getFullName();

    /**
     * Return email address of a given user
     *
     * @return string
     */
    abstract public function getEmail();
}
