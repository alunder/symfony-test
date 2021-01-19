<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PostalCodeType;
use App\Service\LogicHelper;

class PostcodeController extends AbstractController
{
    /**
     * @Route("/postcode", name="postcode", methods={"GET","POST"})
     */
    public function index()
    {
	   	$defaultData = array();
	   	$post_code_exists = "";
    	$postalcodeform = $this->createForm(PostalCodeType::class, $defaultData, ['method' => 'GET']);

    	if (isset($_GET['postal_code'])) {
    		$inputpostcode = $_GET['postal_code']['postal_code'];
    		$logic_helper = new LogicHelper();
    		$post_code_exists = $logic_helper->verifyPostCode($inputpostcode);
    	}

        return $this->render('postcode/postcode.html.twig', [
            'postalcodeform' => $postalcodeform->createView(),
            'post_code_exists' => $post_code_exists
        ]);
    }

    /**
     * @Route("/home", name="home", methods={"GET","POST"})
     */
    public function home()
    {
        return $this->render('postcode/index.html.twig', [
        ]);
    }

}
