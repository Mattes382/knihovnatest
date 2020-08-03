<?php

namespace App\Controller;

use App\Entity\Knihy;
use App\Entity\Zanry;
use App\Form\KnihaEditType;
use App\Form\KnihaType;
use App\Form\ZanrAddType;
use App\Form\ZanrType;
use App\Repository\KnihyRepository;
use App\Repository\ZanryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/zanr", name="zanr")
 */
class ZanrController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(ZanryRepository $zanryRepository)
    {
        return $this->render('zanr/index.html.twig');
    }
    /**
     * @Route("/new", name="create")
     */
    public function create(Request $request)
    {
        $zanr = new Zanry();

        $form = $this->createForm(ZanrAddType::class, $zanr);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


            $em = $this->getDoctrine()->getManager();
            $em->persist($zanr);
                $em->flush();
                $this->addFlash('success', 'Žánr úspěšně přidán');
                return $this->redirect($this->generateUrl('adminzanr'));



        }

        return $this->render('zanr/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id}/edit", name="edit")
     */
    public function update($id, Request $request, ZanryRepository $zanryRepository)
    {
        $zanrvybrany = $zanryRepository->find($id);
        $form = $this->createForm(ZanrType::class, $zanrvybrany);
        $form->get('Nazev')->setData($zanrvybrany->getNazev());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Údaje žánru úspěšně změněny');
            return $this->redirect($this->generateUrl('adminzanr'));
        }

        return $this->render('zanr/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id, ZanryRepository $zanryRepository)
    {
        $zanr = $zanryRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($zanr);
        $em->flush();
        $this->addFlash('warning', 'Žánr byl odstraněn');

        return $this->redirect($this->generateUrl('adminzanr'));
    }
}
