<?php
declare(strict_types=1);

namespace Liox\B2B\Controller;

use Liox\B2B\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LoginController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {}

    #[Route(path: '/', name: 'homepage', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render('homepage.html.twig', [
            'products' => $this->productRepository->findAll(),
        ]);
    }
}
