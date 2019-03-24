<?php

namespace SMARTONE\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\UserBundle\Entity\User;
use SMARTONE\UserBundle\Form\UserType;

/**
 * User controller.
 *
 * @Route("/rest/users")
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     * @Route("/", name="rest_user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEUserBundle:User')->findAll();

        $users = [];
        /** @var User $user */
        foreach ($entities as $user) {
            $users[] = array('name' => $user->getName(), 'pin' => $user->getPin());
        }

        return new JsonResponse($users);
    }
}
