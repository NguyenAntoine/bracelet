<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 12/04/2019
 * Time: 12:39
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function home()
    {
        return $this->render('home/home.html.twig');
    }
}
