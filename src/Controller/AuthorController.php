<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Knihy;
use App\Form\AuthorType;
use App\Form\KnihaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/author", name="author")
 */
class AuthorController extends AbstractController
{
    /**
     * @Route("/all", name="author")
     */
    public function index()
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    /**
     * @Route("/new", name="create")
     */
    public function create(Request $request)
    {
        $autor = new Author();

        $form = $this->createForm(AuthorType::class, $autor);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($autor);
            try {
                $em->flush();
                $this->addFlash('success', 'Autor úspěšně přidán');
                return $this->redirect($this->generateUrl('authorcreate'));
            } catch (\Exception $exception) {
                dump($autor);
            }


        }

        return $this->render('author/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
