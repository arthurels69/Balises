<?php


namespace App\Controller;

use App\Repository\ShowDateRepository;
use App\Repository\SpectacleRepository;
use App\Service\CalendarService;
use Mapado\RestClientSdk\SdkClient;
use Mapado\RestClientSdk\Tests\Units\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

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
    public function calendarHome(Request $request)
    {

        $today = new \DateTime();
        $todayString = $today->format("Y-m-d");

        //IF INPUT used // Date transmitted by the "rechercher par date" formular
        if ($request->request->get('picked_date')) {
            $todayString = $request->request->get('picked_date');
        }

        return $this->render('Calendar/calendar.html.twig', [
            'today' => $todayString,
            'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesOfTheDay($todayString),
            'oneMoreDay' => $this->calendarService->addMoreDays(),
        ]);
    }

    /**
     * Display the calendar with the selected date as input.
     * @param Request $request
     * @return ResponseAlias
     * @throws \Exception
     * @Route("/calendar/{day}", name="calendar_select_day", methods={"GET", "POST"})
     */
    public function calendarSelectedDay(Request $request)
    {

        //Retrieves the date passed in URI.
        $selectedDay = substr($request->getUri(), -10);

        //IF INPUT used // Date transmitted by the "rechercher par date" formular
        if ($request->request->get('picked_date')) {
            $selectedDay = $request->request->get('picked_date');
        }


         return $this->render('Calendar/calendar.html.twig', [
               'today' => $selectedDay,
               'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesOfTheDay($selectedDay),
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

        $selectedDay = $request->attributes->get('day');

        return $this->render('Calendar/ajaxSpectacles.html.twig', [
            'today' => $selectedDay,
            'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesOfTheDay($selectedDay)
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/calendar/{day}/asyncPlusOne", name="async_calendarPlusOne", methods={"GET", "POST"})
     */
    public function asyncPlusOne(Request $request) : Response
    {
        $selectedDay = $request->attributes->get('day');

        $newSpectacles = $this->calendarService->selectSpectaclesOfTheDay($selectedDay);

        return $this->render('Calendar/ajaxSpectaclesNextDay.html.twig', ['spectaclesOfTheDay' => $newSpectacles]);
    }
}
