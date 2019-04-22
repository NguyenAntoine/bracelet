<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 12/04/2019
 * Time: 12:38
 */

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class LoginController extends AbstractFOSRestController
{
    /**
     * Redirect users after login based on the granted ROLE
     * @Rest\Route("/login/redirect", name="login_redirect")
     */
    public function loginRedirectAction()
    {
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->redirectToRoute('homepage');
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
}
