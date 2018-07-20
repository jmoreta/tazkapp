<?php
/**
 * Created by PhpStorm.
 * User: Stephany Marmolejos
 * Date: 7/21/2018
 * Time: 9:40 PM
 */

namespace AppBundle\Controller\tickets;

use AppBundle\Entity\Tickets;
use AppBundle\Entity\Usuario;
use AppBundle\Form\TicketsType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketsController extends Controller
{

    /**
     * @Route("/tickets",name="vista_tickets")
     *
     */
    public function indexTickets()
    {

        $ticket = $this->getDoctrine()
            ->getRepository(Tickets::class)
            ->findAll();

        return $this->render('@App/Tickets/verlistanormal.html.twig', ["tickets" => $ticket]);

    }

    /**
     * @Route("/tickets/pendientes",name="tickets_pendientes")
     *
     */
    public function pendientesTickets()
    {
        $ticket = $this->getDoctrine()
            ->getRepository(Tickets::class)
            ->findBy(['estado' => "pendiente"]);

        return $this->render('@App/Tickets/verlistanormal.html.twig', ["tickets" => $ticket]);

    }

    /**
     * @Route("/tickets/proceso",name="Tickets_enproceso")
     */
    public function procesoTickets()
    {
        $ticket = $this->getDoctrine()
            ->getRepository(Tickets::class)
            ->findBy(['estado' => "En proceso"]);

        return $this->render('@App/Tickets/verlistanormal.html.twig', ["tickets" => $ticket]);

    }


    /**
     * @Route("/tickets/ver/",name="vertickets_normal")
     *
     *
     */
    public function verTicketsn()
    {

        $ticket = $this->getDoctrine()
            ->getRepository(Tickets::class)
            ->findAll();
        return $this->render('@App/Tickets/verticketnormal.html.twig', ["tickets" => $ticket]);

    }

    /**
     * @Route("/nuevo",name="nuevo_tickets",options={"expose"=true})
     */
    public function nuevoTickets()
    {
        return $this->render('@App/Tickets/creartickets.html.twig');

    }

//    /**
//     * @Route("/userlist",name="cargar_usuarios")
//     * @Method("GET")
//     *
//     */
//    public function usuariosAsignar()
//    {
//
//        $usuarios = $this->getDoctrine()->getRepository(Usuario::class)->findBy(["tipousuario"=>"Tecnico"]);
//
//        return [$usuarios];
//    }


//restfull api

    /**
     * @Route("/tickets/nuevo",name="crear_tickets",options={"expose"=true})
     * @Method("POST")
     */
    public function nuevoTicket(Request $request)
    {
        $data = $request->getContent();
        $data = json_decode($data, true);

        $tickets = new Tickets();
        $form = $this->createForm(TicketsType::class, $tickets);
        $form->submit($data);


        if ($form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($tickets);


            $em->flush();
        }

        return new JsonResponse(null, 400);
    }


    /**
     * @Route("/tickets/actualizar/{id}",name="actualizar_tickets")
     * @Method("PUT")
     * @param Tickets $ticket
     * @return JsonResponse
     */
    public function actualizarTickets(Request $request, Tickets $ticket)
    {

        $data = $request->getContent();
        $data = json_decode($data, true);


        $form = $this->createForm(TicketsType::class, $ticket);
        $form->submit($data);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $jsonContent = $this->get('serializer')->serialize($ticket, 'json');
            $jsonContent = json_decode($jsonContent, true);

            return new JsonResponse($jsonContent);
            return null;

        }


    }


}