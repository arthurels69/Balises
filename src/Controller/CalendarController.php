<?php


namespace App\Controller;

use App\Repository\ShowDateRepository;
use App\Repository\SpectacleRepository;
use App\Service\CalendarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    public function __construct(CalendarService $calendarService, ShowDateRepository $showDateRepository, SpectacleRepository $spectacleRepository)
    {
        $this->calendarService = $calendarService;
        $this->showDateRepository = $showDateRepository;
        $this->spectacleRepository = $spectacleRepository;
    }

    /**
     * Displays the calendar at first visit on Calendar Page.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @Route("/calendar/",
     *      name="calendar_home",
     *     methods={"GET", "POST"})
     */
    public function calendarHome()
    {
        $today = new \DateTime();
		$todayString = $today->format("Y-m-d");

        return $this->render('Calendar/calendar.html.twig', [
            'today' => $today,
			'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesOfTheDay($todayString), // Array of spectacle object taking place on the selected day
            'oneMoreDay' => $this->calendarService->addMoreDays()  // array of Strings applied in the twig date_modify filter to increment days in the calendar carousel
        ]);
    }

    /**
     * Display the calendar with the selected data as input.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @Route("/calendar/{day}", name="calendar_select_day")
     */
    public function calendarSelectedDay(Request $request)
    {
        //Retrieves the date passed in URI.
		$selectedDay = substr($request->getUri(), -10);

        // Date transmitted by the "rechercher par date" formular
        if ($request->request->get('picked_date')) {

            $selectedDate = $request->request->get('picked_date');

			return $this->render('Calendar/calendar.html.twig', [
                'today' => $selectedDate,
                'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesOfTheDay($selectedDate), // Array of spectacle object taking place on the selected day
                'oneMoreDay' => $this->calendarService->addMoreDays()  // array of Strings applied in the twig date_modify filter to increment days in the calendar carousel
            ]);

            //If a date is passed in URI (selected on the carousel calendar)
        } elseif (!empty($selectedDay)) {
            return $this->render('Calendar/calendar.html.twig', [
                'today' => $selectedDay,
				'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesOfTheDay($selectedDay), // Array of spectacle object taking place on the selected day
                'oneMoreDay' => $this->calendarService->addMoreDays()  // array of Strings applied in the twig date_modify filter to increment days in the calendar carousel
            ]);
        }
    }
}
