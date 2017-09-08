<?php

/*
 * This file is part of the cache Vagrant.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @Method({"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('app/default/index.html.twig');
    }

    /**
     * @Route("/esi", name="cache_page")
     *
     * @Method({"GET"})
     *
     * @return Response
     */
    public function cacheAction()
    {
        $response = new Response();
        $response->setSharedMaxAge(10);
        $response->setPublic();
        $response->setMaxAge(10);
        $response->setContent($this->render('formation/cache.html.twig', array('hello' => 'Hello World!!!')));

        return $response;
    }

    /**
     * Request $request
     * @return Response
     */
    public function getEsiCacheAction(Request $request)
    {
        $response = new Response();
        $response->setSharedMaxAge(10);
        $response->setPublic();
        $response->setMaxAge(10);

        // Check that the Response is not modified for the given Request
        if (!$response->isNotModified($request)) {
            $date = new \DateTime();
            $response->setLastModified($date);
            $response->setContent($this->renderView('formation/esi.html.twig', array('hello' => 'HELLO DHM IT')));
        }

        return $response;
    }
}
