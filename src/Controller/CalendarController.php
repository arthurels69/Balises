<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** Controls the Calendar Pages
 * Class CalendarController
 * @package App\Controller
 */
class CalendarController extends AbstractController
{
     /**
      * Displays the calendar and sends shows data
      * @Route("/calendar", name="calendar_home", methods={"GET", "POST"})
     */
    public function calendarHome(Request $request)
    {

        // array of Strings applied in the twig date_modify filter
        $oneMoreDay = [];
        for ($i = 0; $i < 14; $i++) {
            $oneMoreDay[$i] = "+$i day";
        }

		// Date transmitted by the "rechercher par date" formular
        if ($request->request->get('picked_date')) {

            $pickedDate = $request->request->get('picked_date');

            return $this->render('Calendar/calendar.html.twig', [
                'today' => $pickedDate,
                'oneMoreDay' => $oneMoreDay
                ]);
        }

        $today = new \DateTime();

        return $this->render('Calendar/calendar.html.twig', [
            'today' => $today,
            'oneMoreDay' => $oneMoreDay
        ]);
    }
}
