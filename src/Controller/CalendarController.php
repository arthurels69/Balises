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
			'oneMoreDay' => $oneMoreDay
		]);
    }

	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \Exception
	 * @Route("/calendar/{day}", name="calendar_select_day")
	 */
	public function calendarSelectedDay(Request $request)
	{
		//Retrieves the date passed in URI.
		$selectedDay = new \DateTime(substr($request->getUri(), -10));

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
				'oneMoreDay' => $oneMoreDay,
			]);

			//If a date is passed in URI (selected on the carousel calendar)
		} elseif (!empty($selectedDay)) {
			return $this->render('Calendar/calendar.html.twig', [
				'today' => $selectedDay,
				'oneMoreDay' => $oneMoreDay,
			]);
			//If no date at all is given (first access to the page)
		}
	}

}
