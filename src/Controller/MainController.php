<?php

namespace App\Controller;

use App\Repository\KnihyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(KnihyRepository $knihyRepository)
    {
        $knihy = $knihyRepository->sortByCreatedAtDesc();

        return $this->render('knihy/index.html.twig', [
            'knihy' => $knihy
        ]);
    }


}
