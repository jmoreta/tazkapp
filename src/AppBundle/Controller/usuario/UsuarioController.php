<?php
/**
 * Created by PhpStorm.
 * User: Stephany Marmolejos
 * Date: 7/18/2018
 * Time: 12:33 AM
 */

namespace AppBundle\Controller\usuario;

use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class UsuarioController extends controller
{
    /**
     * @Route("/usuarios",name="vista_usuarios",options={"expose"=true})
     */
    public function indexUsuario()
    {
        return $this->render('@App/Usuario/vistadeusuario.html.twig');
    }





    //Restfull

    /**
     * @Route("/rest/usuarios",name="insertar_usuario",options={"expose"=true})
     * @Method ("POST")
     *
     */
    public function guardaUsuario(Request $request)
    {

        $data = $request->getContent();
        $data = json_decode($data, true);

        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->submit($data);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager();

            $em->persist($usuario);
            $em->flush();
        }

        return new JsonResponse(null, 400);
    }


    /**
     * @Route("/rest/usuarios/{id}",name="actualizar_usuario",options={"expose"=true})
     * @Method("PUT")
     */
    public function actualizarUsuario(Request $request)
    {

        $data = $request->getContent();
        $data = json_decode($data, true);

        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->submit($data);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($usuario);
            $em->flush();
        }

        return new JsonResponse(null, 400);
    }


}