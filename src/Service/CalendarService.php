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
        for ($i = 1; $i < 31; $i++) {
            $oneMoreDay[$i] = "+$i day";
        }

        return $oneMoreDay;
    }


    public function selectSpectaclesOfTheDay($selectedDate) : array
    {

        $start = new \DateTime($selectedDate);
        $end = new \DateTime($selectedDate);

        $end->add(\DateInterval::createFromDateString('+31 days'));

        //Returns  today' spectacles.
        $spectaclesOfTheDay = $this->showDateRepository->spectaclePerDates($start, $end);

        //Returns the content of today' sgit pectacles based on the IDs collected  above.

        return $spectaclesOfTheDay;
    }

    public function selectSpectacles3NextDays($selectedDate) : array
    {

        $start = new \DateTime($selectedDate);
        $end = new \DateTime($selectedDate);

        $end->add(\DateInterval::createFromDateString('+3 days'));

        //Returns  today' spectacles.
        $spectaclesOfTheDay = $this->showDateRepository->spectaclePerDates($start, $end);

        //Returns the content of today' sgit pectacles based on the IDs collected  above.

        return $spectaclesOfTheDay;
    }

    public function selectSpectaclesNextWeek($selectedDate) : array
    {
        $start = new \DateTime($selectedDate);
        $end = new \DateTime($selectedDate);

        $end->add(\DateInterval::createFromDateString('+7 days'));

        //Returns  today' spectacles.
        $spectaclesOfTheDay = $this->showDateRepository->spectaclePerDates($start, $end);

        //Returns the content of today' sgit pectacles based on the IDs collected  above.

        return $spectaclesOfTheDay;
    }
}
