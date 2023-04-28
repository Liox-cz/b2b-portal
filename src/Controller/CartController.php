<?php
declare(strict_types=1);

namespace Liox\B2B\Controller;

use Liox\B2B\Services\Cart\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CartController extends AbstractController
{
    public function __construct(
        private readonly Cart $cart,
    ) {
    }

    #[Route(path: '/cart', name: 'cart', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render('cart.html.twig', [
            'cart_items' => $this->cart->items(),
        ]);
    }
}
