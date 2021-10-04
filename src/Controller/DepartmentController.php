<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{
    /**
     * @Route("/department", name="department")
     */
    public function index(): Response
    {
        return new Response(<<<EOF
<html>
 <body>
 <h1>hola guapi!!!!</h1>
</body>
</html>
EOF
 );
    }
}
