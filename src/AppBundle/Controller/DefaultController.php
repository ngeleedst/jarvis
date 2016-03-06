<?php

namespace AppBundle\Controller;

use AppBundle\Model\Socket;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $latestTemp = $em->getRepository('AppBundle:Temperature')->findlatest();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'latestTemp' => $latestTemp
        ));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/api", name="api")
     */
    public function apiAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $date = new \DateTime();

        /** @var \Doctrine\ORM\Query $blogItems */
        $blogItems = $em->getRepository('AppBundle:Temperature')->range($date);

        $data = [];
        foreach($blogItems->getResult() as $result){
            $data[] = $result->toArray();
        }

        return new JsonResponse($data);
    }
}
