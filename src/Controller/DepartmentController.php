<?php

namespace App\Controller;

use App\Entity\Department;
use App\Repository\DepartmentRepository;
use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DepartmentController extends AbstractController
{
    /**
     * @Route("/prova", name="prova")
     */
    public function index_prova(Environment $twig, DepartmentRepository $departmentRepository): Response
    {
        return new Response(<<<EOF
                            <html>
                            <body>fuckyou!!!</body>
                            </html>
EOF
                            );
    }

    /**
     * @Route("/departments", name="departments")
     */
    public function index(Environment $twig, DepartmentRepository $departmentRepository): Response
    {
        return new Response($twig->render('department/index.html.twig',['departments'=> $departmentRepository->findAll()]));
    }

    /**
     * @Route("/department/{id}", name="department_id")
     */
    public function show(Environment $twig, Department $department, PersonaRepository $personaRepository ): Response
    {
        return new Response($twig->render('department/show.html.twig',['department'=> $department, 'persones' => $personaRepository->findby(['department'=> $department],['cognoms'=> 'ASC'])]));
    }
}
