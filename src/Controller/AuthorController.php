<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Knihy;
use App\Entity\Zanry;
use App\Form\AuthorEditType;
use App\Form\AuthorType;
use App\Form\KnihaType;
use App\Form\ZanrAddType;
use App\Form\ZanrType;
use App\Repository\AuthorRepository;
use App\Repository\ZanryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/author", name="author")
 */
class AuthorController extends AbstractController
{
    /**
     * @Route("/all", name="index")
     */
    public function index(AuthorRepository $authorRepository)
    {
        $authors = $authorRepository->AuthorsBooks();
        dump($authors);
        return $this->render('author/index.html.twig', [
            'authors' => $authors
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

    /**
     * @Route("/{id}/edit", name="edit")
     */
    public function update($id, Request $request, AuthorRepository $authorRepository)
    {
        $authorvybran = $authorRepository->find($id);
        $form = $this->createForm(AuthorEditType::class, $authorvybran);
        $form->get('jmeno')->setData($authorvybran->getJmeno());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Údaje autora úspěšně změněny');
            return $this->redirect($this->generateUrl('adminauthor'));
        }

        return $this->render('zanr/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($author);
        $em->flush();
        $this->addFlash('warning', 'Autor byl odstraněn');

        return $this->redirect($this->generateUrl('adminauthor'));
    }
}
