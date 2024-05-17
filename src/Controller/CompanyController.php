<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Company;
use App\Entity\User;
use App\Form\CompanyFormType;


class CompanyController extends AbstractController
{
    #[Route('/company/create', name: 'app_company')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if ($user->getCompany()) {
            return $this->redirectToRoute('app_dashboard');
        }

        $company = new Company();
        $form = $this->createForm(CompanyFormType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $company->setUserId($user);
            $entityManager->persist($company);

            // Ajouter le rôle ROLE_COMPANY à l'utilisateur
            $roles = $user->getRoles();
            if (!in_array('ROLE_COMPANY', $roles)) {
                $roles[] = 'ROLE_COMPANY';
                $user->setRoles($roles);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('company/create.html.twig', [
            'companyForm' => $form->createView(),
        ]);
    }
}
