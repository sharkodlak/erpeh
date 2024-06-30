<?php

namespace App\Controller;

use App\Service\JobService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobsController extends AbstractController
{
    public function __construct(
        private readonly JobService $jobService,
    ) { 
    }

    #[Route('/jobs', name: 'jobs')]
    public function index(): Response
    {
        $jobs = $this->jobService->getJobs();

        return $this->render('jobs/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }
}
