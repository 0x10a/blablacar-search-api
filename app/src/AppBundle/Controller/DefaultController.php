<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FormData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\BlaBlaCar\BlaBlaCar;

class DefaultController extends Controller
{
    function __construct()
    {
        $this->blablacarService = new BlaBlaCar();
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $formdata = new FormData();
        //Creating search form
        $form = $this->createForm('AppBundle\Form\BlaBlaCarForm', $formdata);
        $form->handleRequest($request);
        if (!$form->isSubmitted() && !$form->isValid()) {
            $trips = $this->blablacarService->getTrips();

            return $this->render('default/results.html.twig', array(
                'trips' => $trips
            ));
    }

        //Rendering the Form
        return $this->render('default/form.html.twig', array(
            'datum' => $formdata,
            'form' => $form->createView(),
        ));
    }
}
