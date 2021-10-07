<?php

namespace App\EventSubscriber;

use App\Repository\DepartmentRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $departmentRepository;

    public function __construct(Environment $twig, DepartmentRepository $departmentRepository)
    {
        $this->twig = $twig;
        $this->departmentRepository = $departmentRepository;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $this->twig->addGlobal('departments', $this->departmentRepository->findAll());
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
