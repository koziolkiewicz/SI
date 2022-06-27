<?php
/**
 * Question controller.
 */

namespace App\Controller;

use App\Entity\Question;
use App\Service\QuestionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class QuestionController.
 */
#[Route('/question')]
class QuestionController extends AbstractController
{
    /**
     * Question service.
     */
    private QuestionService $questionService;

    /**
     * Constructor.
     */
    public function __construct(QuestionService $questionService)
    {
        $this->QuestionService = $questionService;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route(name: 'question_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $pagination = $this->QuestionService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('Question/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Question $question Question
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'question_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Question $question): Response
    {
        return $this->render('question/show.html.twig', ['question' => $question]);
    }
}