<?php


namespace App\Controller;

use App\Repository\NonBalisesTheaterRepository;
use App\Repository\ShowDateRepository;
use App\Repository\SpectacleRepository;
use App\Repository\TheaterRepository;
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
class ListController extends AbstractController
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
     * @Route("/theaters/",
     *      name="/theaters_list",
     *     methods={"GET", "POST"})
     */
    public function theaterList(
        Request $request,
        TheaterRepository $theaterRepository,
        NonBalisesTheaterRepository $nonBalisesTheaterRepository
    ) {


        return $this->render('theater/list.html.twig', [
            'theaters' => $theaterRepository->findAll(),
            'nonBalisesTheaters' => $nonBalisesTheaterRepository->findAll()
        ]);
    }
}
