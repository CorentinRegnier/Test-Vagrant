<?php

/*
 * This file is part of the cache Vagrant.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class CommentController
 */
class CommentController extends FOSRestController
{
    /**
     * @return JsonResponse
     *
     * @Rest\Get("/comments")
     */
    public function getUsersAction()
    {
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')->findBy(['status' => true]);
        $result = [];

        foreach ($comments as $comment) {
            $result[] = [
                'content' => $comment->getContent(),
                'lastNameUser' => $comment->getUser()->getLastName(),
                'firstNameUser' => $comment->getUser()->getFirstName(),
            ];
        }

        return new JsonResponse([
            'comments' => $result,
        ], 200);
    }

    /**
     * @return Response
     */
    public function redirectAction()
    {
        $view = $this->redirectView($this->generateUrl('homepage'), 301);

        return $this->handleView($view);
    }
}