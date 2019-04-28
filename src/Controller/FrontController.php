<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/28/19
 * Time: 11:10 PM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/",name="front_index")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }
}