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



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class UsuarioController extends controller
{
    /**
     * @Route("/usuarios",name="vista_usuarios",options={"expose"=true})
     */
    public function indexUsuario()
    {
        return $this->render('@App/Usuario/registrousuarios.html.twig');
    }



    /**
     * @Route("/usuario/{id}",name="actualizar",options={"expose"=true})
     * @Method("GET")
     * @param Usuario $usuarios
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function actualizarU(Usuario $usuario)
    {


        return $this->render("@App/Usuario/editarusuario.html.twig",
            ["usuarios" => $usuario]

        );


    }


    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
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
     * @param Request $request
     * @param Usuario $usuario
     * @return JsonResponse
     */
    public function actualizarUsuario(Request $request, Usuario $usuario)
    {

        $data = $request->getContent();
        $data = json_decode($data, true);

        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->submit($data);


        $em = $this->getDoctrine()->getManager();

        $em->flush();

        $jsonContent = $this->get("serializer")->serialize($usuario, 'json');
        $jsonContent = json_decode($jsonContent, true);

        return new JsonResponse($jsonContent);
        return null;


    }


    /**
     * @Route("/rest/eliminar/{id}")
     * @Method("DELETE")
     * @param Usuario $id
     */
    public function eliminarUsuario($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();


    }


}