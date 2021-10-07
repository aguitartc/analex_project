<?php

namespace App\Controller;

use App\Entity\Department;
use App\Repository\DepartmentRepository;
use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DepartmentController extends AbstractController
{
    private $twig;
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="home")
     */
    public function index_prova(DepartmentRepository $departmentRepository): Response
    {
        return new Response(<<<EOF
                            <html lang="ca">
                            <body>Holaaaa!!! 
                                <p><a href="/departments">Departaments</a> </p>
                            </body>
                            </html>
EOF
                            );
    }

    /**
     * @Route("/departments", name="departments")
     */
    public function index(DepartmentRepository $departmentRepository): Response
    {
        return new Response($this->twig->render('department/index.html.twig',['departments'=> $departmentRepository->findAll()]));
    }

    /**
     * @Route("/department/{id}", name="department_id")
     */
    public function show(Request $request,Department $department, PersonaRepository $personaRepository ): Response
    {
        $offset     = max(0, $request->query->getInt('offset',0));
        $paginator  = $personaRepository->getPersonaPaginator($department,$offset);

        return new Response($this->twig->render('department/show.html.twig',
                                            ['department'=> $department,
                                             'persones' => $paginator,
                                             'previous'=> $offset - PersonaRepository::PAGINATOR_PER_PAGE,
                                             'next'=> min(count($paginator), $offset + PersonaRepository::PAGINATOR_PER_PAGE)
                                            ]));
    }
}
