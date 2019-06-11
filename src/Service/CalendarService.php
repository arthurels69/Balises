<?php


namespace App\Service;

use App\Repository\ShowDateRepository;
use App\Repository\SpectacleRepository;

class CalendarService
{
    private $showDateRepository;
    private $spectacleRepository;

    public function __construct(ShowDateRepository $showDateRepository, SpectacleRepository $spectacleRepository)
    {
        $this->spectacleRepository = $spectacleRepository;
        $this->showDateRepository = $showDateRepository;
    }

    public function addMoreDays() : array
    {
        // array of Strings applied in the twig date_modify filter
        $oneMoreDay = [];
        for ($i = 0; $i < 14; $i++) {
            $oneMoreDay[$i] = "+$i day";
        }

        return $oneMoreDay;
    }


    public function selectSpectaclesOfTheDay($selectedDate) : array
    {
        $dateSpectacle = new \DateTime($selectedDate);

        $dateShowPlusOne = new \DateTime($selectedDate);

        $dateShowPlusOne->add(\DateInterval::createFromDateString('+1 day'));

        //Returns the id of today' spectacles.
        $idSpectaclesOfTheDay = $this->showDateRepository->findByDate($dateSpectacle, $dateShowPlusOne);

        //Returns the content of today' spectacles based on the ID collected 2 lines above.
        $spectaclesOfTheDay = [];
        foreach ($idSpectaclesOfTheDay as $key => $value) {
            $spectaclesOfTheDay[$key] = $this->spectacleRepository->find($value);
        }

        return $spectaclesOfTheDay;
    }
}
