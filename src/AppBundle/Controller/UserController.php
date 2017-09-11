<?php

/*
 * This file is part of the Test Vagrant.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 *
 * @Route("/utilisateurs")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user_index")
     *
     * @Method({"GET"})
     *
     * @return Response
     */
    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findBy(['enabled' => true]);

        return $this->render('app/user/index.html.twig', ['users' => $users]);
    }
}
