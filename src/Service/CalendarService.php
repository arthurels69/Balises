<?php


namespace App\Service;

use App\Repository\ShowDateRepository;
use App\Repository\SpectacleRepository;
use Doctrine\ORM\EntityManagerInterface;

class CalendarService
{
    private $showDateRepository;
    private $spectacleRepository;
    private $entityManager;

    public function __construct(
        ShowDateRepository $showDateRepository,
        SpectacleRepository $spectacleRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->spectacleRepository = $spectacleRepository;
        $this->showDateRepository = $showDateRepository;
        $this->entityManager = $entityManager;
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

        $end->add(\DateInterval::createFromDateString('+1 days'));
        $today = new \DateTime();
        //Returns  today' spectacles.
        $spectaclesOfTheDay = $this->showDateRepository->spectaclePerDates($start, $end, $today);

        //Returns the content of today' sgit pectacles based on the IDs collected  above.

        return $spectaclesOfTheDay;
    }

    public function selectSpectacles5NextDays($selectedDate) : array
    {
        $today = new \DateTime();
        $start = new \DateTime($selectedDate);
        $end = new \DateTime($selectedDate);

        $end->add(\DateInterval::createFromDateString('+5 days'));

        //Returns  today' spectacles.
        $spectaclesOfTheDay = $this->showDateRepository->spectaclePerDates($start, $end, $today);

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
