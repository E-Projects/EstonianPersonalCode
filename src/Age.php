<?php

namespace EProjects\EstonianPersonalCode;

use DateTime;

class Age
{

    /**
     * @var PersonalCodeInterface
     */
    private $personalCode;

    /**
     * @param PersonalCodeInterface $personalCode
     */
    public function __construct(PersonalCodeInterface $personalCode)
    {

        $this->personalCode = $personalCode->getId();
    }

    /**
     * Returns birthday date
     *
     * @return string
     */
    public function getBirthday()
    {

        $birthday = $this->century() .
            substr($this->personalCode, 1, 2) . '-' .
            substr($this->personalCode, 3, 2) . '-' .
            substr($this->personalCode, 5, 2);

        return $birthday;
    }

    /**
     * Returns person age in days
     *
     * @return int
     */
    public function getAgeInDays()
    {

        $birthDate = new DateTime($this->getBirthday());
        $today = new DateTime('today');

        return $birthDate->diff($today)->days;
    }

    /**
     * @return integer
     */
    protected function century()
    {

        $century = array(
            1 => array('Man', '18'),
            array('Woman', '18'),
            array('Man', '19'),
            array('Woman', '19'),
            array('Man', '20'),
            array('Woman', '20'),
        );

        $firstDigit = substr($this->personalCode, 0, 1);

        return $century[$firstDigit][1];
    }
}
