<?php
/**
 * Created by PhpStorm.
 * User: Stephany Marmolejos
 * Date: 7/21/2018
 * Time: 1:33 PM
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login",name="loginp",options={"expose"=true})
     *
     */
    public function loginUsuario(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@App/security/login.html.twig',
            ['last_username' => $lastUsername,
              'error' => $error,
            ]);


    }


}