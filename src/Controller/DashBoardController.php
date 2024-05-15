<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

class DashBoardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('dashboard/base.html.twig', [
            'user' => $userRepository->findAll(),
        ]);
    }

    #[Route('/dashboard/test', name: 'app_dashboard_test')]
    public function test(UserRepository $userRepository): Response
    {
        return $this->render('dashboard/test.html.twig', [
            'user' => $userRepository->findAll(),
        ]);
    }

    #[Route('/dashboard/components', name: 'app_dashboard_components')]
    public function components(UserRepository $userRepository): Response
    {
        return $this->render('dashboard/components.html.twig', [
            'user' => $userRepository->findAll(),
        ]);
    }
}
