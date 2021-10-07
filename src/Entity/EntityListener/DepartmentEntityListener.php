<?php

namespace App\EventListener;

use App\Entity\Department;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class DepartmentEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Department $department, LifecycleEventArgs $event)
    {
        $department->computeSlug($this->slugger);
    }

    public function preUpdate(Department $department, LifecycleEventArgs $event)
    {
        $department->computeSlug($this->slugger);
    }
}