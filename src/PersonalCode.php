<?php

namespace EProjects\EstonianPersonalCode;

/**
 * Value object for personal code
 *
 * @author    Laurynas Gavienas
 * @copyright 2015 Laurynas Gavienas / E-Projects (http://www.e-projects.lt)
 * @licence   http://www.opensource.org/licenses/mit-license.php MIT
 */
class PersonalCode implements PersonalCodeInterface
{

    /**
     * @var int
     */
    private $personalCode;

    public function __construct($personalCode)
    {

        $this->personalCode = $personalCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {

        return $this->personalCode;
    }
}
