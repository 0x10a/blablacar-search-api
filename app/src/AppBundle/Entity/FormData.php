<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Data
 *
 */
class FormData
{

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="3",maxMessage="Departure city Should have at least 3 Characters")
     */
    private $departureCity;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="3",maxMessage="Arrival city Should have at least 3 Characters")
     */
    private $ArrivalCity;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @Assert\Length(max="10",min="10",exactMessage="Time start field error")
     *
     */
    private $timeStart;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="10",min="10",exactMessage="Time should be exactly 10 digits long.")
     */
    private $timeEnd;

    /**
     * Set departureCity
     *
     * @param string $departureCity
     *
     * @return FormData
     */
    public function setDepartureCity($departureCity)
    {
        $this->departureCity = $departureCity;

        return $this;
    }

    /**
     * Get departureCity
     *
     * @return string
     */
    public function getDepartureCity()
    {
        return $this->departureCity;
    }

}

