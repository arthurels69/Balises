<?php


namespace App\Controller;

use App\Repository\ShowDateRepository;
use App\Repository\SpectacleRepository;
use App\Repository\TheaterRepository;
use App\Service\CalendarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** Controls the Calendar Pages
 * Class CalendarController
 * @package App\Controller
 */
class CalendarController extends AbstractController
{

    private $calendarService;
    private $showDateRepository;
    private $spectacleRepository;

    /**
     * CalendarController constructor.
     * @param CalendarService $calendarService
     * @param ShowDateRepository $showDateRepository
     * @param SpectacleRepository $spectacleRepository
     */
    public function __construct(
        CalendarService $calendarService,
        ShowDateRepository $showDateRepository,
        SpectacleRepository $spectacleRepository
    ) {
        $this->calendarService = $calendarService;
        $this->showDateRepository = $showDateRepository;
        $this->spectacleRepository = $spectacleRepository;
    }

    /**
     * Displays the calendar at first visit on Calendar Page.
     * @Route("/calendar/",
     *      name="calendar_home",
     *     methods={"GET", "POST"})
     */
    public function calendarHome(
        Request $request,
        TheaterRepository $theaterRepository,
        SpectacleRepository $spectacleRepository,
        ShowDateRepository $dateRepository
    ) {


        $today = new \DateTime();
        $todayString = [];
        $todayString['full'] = $today->format("Y-m-d");
        $todayString['year'] = substr($todayString['full'], 0, 4);
        $todayString['month'] = substr($todayString['full'], 5, 2);

        $selectedDate['monthAndDay'] = $request->request->get('picked_date');

        $selectedDate['month'] = substr($selectedDate['monthAndDay'], 1, 2);

        //IF INPUT used // Date transmitted by the "rechercher par date" formular
        if ($request->request->get('picked_date')) {
            if ($todayString['month'] > $selectedDate['month']) {
                $todayString['year']++;
            }

                $todayString['full'] = $todayString['year'] . $selectedDate['monthAndDay'];
                $todayString['month'] = $selectedDate['month'];
        }

        $months = [
            'jan',
            'fev',
            'mar',
            'avr',
            'mai',
            'jui',
            'jul',
            'aou',
            'sep',
            'oct',
            'nov',
            'dec'
        ];

        return $this->render('Calendar/calendar2.html.twig', [
            'today' => $todayString['full'],
            'period' => $todayString,
            'months' => $months,
            'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesOfTheDay($todayString['full']),
            'oneMoreDay' => $this->calendarService->addMoreDays(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/calendar/{day}/async", name="async_calendar", methods={"GET", "POST"})
     */
    public function asyncDate(Request $request) :Response
    {

        $selectedDay['full'] = $request->attributes->get('day');

        return $this->render('Calendar/ajaxSpectacles.html.twig', [
            'today' => $selectedDay['full'],
            'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesOfTheDay($selectedDay['full'])
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/calendar/{day}/asyncPlusThree", name="async_calendarPlusOne", methods={"GET", "POST"})
     */
    public function asyncPlusOne(Request $request) : Response
    {
        $selectedDay = $request->attributes->get('day');

        $newSpectacles = $this->calendarService->selectSpectacles3NextDays($selectedDay);

        return $this->render('Calendar/ajaxSpectaclesNextDay.html.twig', ['spectaclesOfTheDay' => $newSpectacles]);
    }

    /**
     * @return Response
     * @throws \Exception
     *  @Route("/calendar/{day}/asyncPlusThreePills", name="async_calendarPlusThreePills", methods={"GET", "POST"})
     */
    public function threeNextDays()
    {
        $selectedDay = new \DateTime();
        $selectedDay = $selectedDay->format("Y-m-d");
        return $this->render('Calendar/ajaxSpectacles.html.twig', [
            'today' => $selectedDay,
            'spectaclesOfTheDay' => $this->calendarService->selectSpectacles3NextDays($selectedDay)
        ]);
    }

    /**
     * @return Response
     * @throws \Exception
     *  @Route("/calendar/{day}/asyncPlusWeekPills", name="async_calendarPlusWeek", methods={"GET", "POST"})
     */
    public function nextWeek()
    {
        $selectedDay = new \DateTime();
        $selectedDay = $selectedDay->format("Y-m-d");
        return $this->render('Calendar/ajaxSpectacles.html.twig', [
            'today' => $selectedDay,
            'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesNextWeek($selectedDay)
        ]);
    }
}
