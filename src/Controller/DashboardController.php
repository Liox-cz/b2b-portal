<?php
declare(strict_types=1);

namespace Liox\B2B\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardController extends AbstractController
{
    #[Route(path: '/', name: 'dashboard', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render('dashboard.html.twig', [
            'products' => [],
        ]);
    }
}
