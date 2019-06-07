<?php


namespace App\Controller;

use App\Service\CalendarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** Controls the Calendar Pages
 * Class CalendarController
 * @package App\Controller
 */
class CalendarController extends AbstractController
{
    // array of Strings applied in the twig date_modify filter
    private $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
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
    public function calendarHome(Request $request)
    {
        $today = new \DateTime();

        // array of Strings applied in the twig date_modify filter
        $oneMoreDay = [];
        for ($i = 0; $i < 14; $i++) {
            $oneMoreDay[$i] = "+$i day";
        }

        return $this->render('Calendar/calendar.html.twig', [
            'today' => $today,
            'oneMoreDay' => $this->calendarService->addMoreDays()
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
        $selectedDay = new \DateTime(substr($request->getUri(), -10));

        // Date transmitted by the "rechercher par date" formular
        if ($request->request->get('picked_date')) {
            $pickedDate = $request->request->get('picked_date');

            return $this->render('Calendar/calendar.html.twig', [
                'today' => $pickedDate,
                'oneMoreDay' => $this->calendarService->addMoreDays()
            ]);

            //If a date is passed in URI (selected on the carousel calendar)
        } elseif (!empty($selectedDay)) {
            return $this->render('Calendar/calendar.html.twig', [
                'today' => $selectedDay,
                'oneMoreDay' => $this->calendarService->addMoreDays()
            ]);
        }
    }
}
