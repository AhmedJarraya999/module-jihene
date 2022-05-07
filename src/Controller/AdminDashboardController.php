<?php

namespace App\Controller;

use App\Service\StatsService;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectManager as PersistenceObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admins", name="admin_dashboard")
     */
    public function index(StatsService $statsService)
    {
        $stats      = $statsService->getStats();
        return $this->render('admin/dashboard/index.html.twig', ['stats' => $stats]);
    }
}
