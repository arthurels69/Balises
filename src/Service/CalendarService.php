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
        for ($i = 1; $i < 14; $i++) {
            $oneMoreDay[$i] = "+$i day";
        }

        return $oneMoreDay;
    }


    public function selectSpectaclesOfTheDay($selectedDate) : array
    {

        $start = new \DateTime($selectedDate);
        $end = new \DateTime($selectedDate);

        $end->add(\DateInterval::createFromDateString('+1 day'));

        //Returns  today' spectacles.
        $idSpectaclesOfTheDay = $this->showDateRepository->findByDates($start, $end);
        dump($start);
        dump($idSpectaclesOfTheDay);
        //Returns the content of today' sgit pectacles based on the IDs collected  above.
        $spectaclesOfTheDay = [];
        foreach ($idSpectaclesOfTheDay as $key => $value) {
            //$spectaclesOfTheDay[$key] = $this->spectacleRepository->findByDatesX($value);
        }


        return $spectaclesOfTheDay;
    }
}
