<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/** Controls the Calendar Pages
 * Class CalendarController
 * @package App\Controller
 */
class CalendarController extends AbstractController
{
     /**
      * Displays the calendar and sends shows data
      * @Route("/calendar", name="calendar_home", methods={"GET"})
     */
    public function calendarHome()
    {


    	$today = new \DateTime();


		// returns an array of Strings used in template and applied in the date_modify filter in the calendar carousel loop to add 1 more day at each loop.
    	for($i = 0; $i < 14; $i++) {
    		$oneMoreDay[$i] = "+$i day";
		}

        return $this->render('Calendar/calendar.html.twig', [
        	'today' => $today,
			'oneMoreDay' => $oneMoreDay
		]);
    }
}
