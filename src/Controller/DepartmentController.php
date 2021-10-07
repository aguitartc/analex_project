<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Entity\Department;
use App\Form\PersonaFormType;
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
        return new Response($this->twig->render('base.html.twig',['departments'=> $departmentRepository->findAll()]));
    }

    /**
     * @Route("/departments", name="departments")
     */
    public function index(DepartmentRepository $departmentRepository): Response
    {
        return new Response($this->twig->render('department/index.html.twig',['departments'=> $departmentRepository->findAll()]));
    }

    /**
     * @Route("/department/{slug}", name="department_slug")
     */
    public function show(Request $request,Department $department, PersonaRepository $personaRepository, DepartmentRepository $departmentRepository ): Response
    {
        $persona = new Persona();
        $form = $this->createForm(PersonaFormType::class, $persona);

        $offset     = max(0, $request->query->getInt('offset',0));
        $paginator  = $personaRepository->getPersonaPaginator($department,$offset);

        return new Response($this->twig->render('department/show.html.twig',
                                            ['department'=> $department,
                                             'departments'=> $departmentRepository->findAll(),
                                             'persones' => $paginator,
                                             'previous'=> $offset - PersonaRepository::PAGINATOR_PER_PAGE,
                                             'next'=> min(count($paginator), $offset + PersonaRepository::PAGINATOR_PER_PAGE),
                                             'persona_form' => $form ->createView()
                                            ]));
    }
    /**
     * @Route("/department_antic_show/{slug}", name="department_anitc_show_slug")
     */
    public function antic_show(Request $request,Department $department, PersonaRepository $personaRepository, DepartmentRepository $departmentRepository ): Response
    {
        $offset     = max(0, $request->query->getInt('offset',0));
        $paginator  = $personaRepository->getPersonaPaginator($department,$offset);

        return new Response($this->twig->render('department/show.html.twig',
                                            ['department'=> $department,
                                             'departments'=> $departmentRepository->findAll(),
                                             'persones' => $paginator,
                                             'previous'=> $offset - PersonaRepository::PAGINATOR_PER_PAGE,
                                             'next'=> min(count($paginator), $offset + PersonaRepository::PAGINATOR_PER_PAGE)
                                            ]));
    }
}
