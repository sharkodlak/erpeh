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
        $page = $request->query->getInt('page', 1);
        $params = new ParamsDto(page: $page);
        $jobs = $this->jobService->getJobs($params);

        return $this->render('jobs/index.html.twig', [
            'jobs' => $jobs,
            'page' => $page,
        ]);
    }
}
