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
                list ($first_name, $last_name) = $this->getFirstAndLastNameFromEmail();

                if ($first_name && $last_name) {
                    $this->full_name_bits = (new HumanNameParser("$first_name $last_name"))->getArray();
                } else {
                    $this->full_name_bits = ['first' => $first_name];
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
}
