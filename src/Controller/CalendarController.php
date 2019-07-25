<?php


namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ShowDateRepository;
use App\Repository\SpectacleRepository;
use App\Repository\TheaterRepository;
use App\Service\CalendarService;
use App\Service\EmailService;
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
        ShowDateRepository $dateRepository,
        EmailService $emailService
    ) {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $emailService->mailContactForm(
                $contactFormData['Votre_Email'],
                $contactFormData['Votre_Message'],
                $contactFormData['Votre_Nom']
            );

            $this->addFlash('success', 'Votre message a bien été envoyé');
            dump($contactFormData);
            return $this->redirectToRoute('calendar');
        }




        $today = new \DateTime();
        $todayString = $today->format("Y-m-d");
        //IF INPUT used // Date transmitted by the "rechercher par date" formular
        if ($request->request->get('picked_date')) {
            dump($request->request->get('picked_date'));
            $todayString = $request->request->get('picked_date');
        }

        return $this->render('Calendar/calendar.html.twig', [
            'today' => $todayString,
            'period' => $todayString,
            'spectaclesOfTheDay' => $this->calendarService->selectSpectaclesOfTheDay($todayString),
            'oneMoreDay' => $this->calendarService->addMoreDays(),
            'email_form' => $form->createView(),
        ]);
    }

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
     * @Route("/calendar/{day}/asyncPlusThree", name="async_calendarPlusOne", methods={"GET", "POST"})
     */
    public function asyncPlusOne(Request $request) : Response
    {
        $selectedDay = $request->attributes->get('day');

        $newSpectacles = $this->calendarService->selectSpectacles5NextDays($selectedDay);

        return $this->render('Calendar/ajaxSpectaclesNextDay.html.twig', ['spectaclesOfTheDay' => $newSpectacles]);
    }
}
