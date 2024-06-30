<?php

namespace App\Controller;

use App\Dto\ParamsDto;
use App\Service\JobService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobsController extends AbstractController
{
    public function __construct(
        private readonly JobService $jobService,
    ) { 
    }

    #[Route('/jobs', name: 'jobs')]
    public function index(Request $request): Response
    {
        $params = new ParamsDto(
            $request->query->getInt('limit', 10),
            $request->query->getInt('page', 1),
            $request->query->getBoolean('with_automation', false),
            $request->query->get('text_language'),
            (array) $request->query->get('workfield_ids'),
            (array) $request->query->get('office_ids'),
            (array) $request->query->get('filter_ids'),
            (array) $request->query->get('channel_ids'),
            $request->query->get('order_by'),
            $request->query->get('activity_state'),
            $request->query->get('access_state'),
            $request->query->get('with_rewards'),
            $request->query->get('updated_from'),
            $request->query->get('updated_to'),
        );
        $jobs = $this->jobService->getJobs($params);

        return $this->render('jobs/index.html.twig', [
            'jobs' => $jobs,
            'params' => $params,
        ]);
    }
}
