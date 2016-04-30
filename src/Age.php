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
     * Age constructor.
     *
     * @param PersonalCodeInterface $personalCode
     */
    public function __construct(PersonalCodeInterface $personalCode)
    {

        $this->personalCode = $personalCode->getId();
    }

    /**
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

    /**
     * @return DateTime
     */
    public function getDateTimeToday()
    {

        return new DateTime('today');
    }

    /**
     * @return DateTime
     */
    public function getBirthDateTime()
    {

        return new DateTime($this->getBirthday());
    }

    /**
     * @param $date1
     * @param $date2
     *
     * @return mixed
     */
    public function getDateTimeDiff($date1, $date2)
    {

        return $date1->diff($date2);
    }

    /**
     * @return int
     */
    public function getAgeInDays()
    {

        $birthDate = $this->getBirthDateTime();
        $today = $this->getDateTimeToday();

        return $this->getDateTimeDiff($birthDate, $today)->days;
    }
}
