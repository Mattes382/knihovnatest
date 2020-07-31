<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Knihy;
use App\Form\KnihaEditType;
use App\Form\KnihaType;
use App\Repository\AuthorRepository;
use App\Repository\KnihyRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @Route("/knihy", name="kniha")
 */
class KnihyController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(KnihyRepository $knihyRepository)
    {
        $knihy = $knihyRepository->findAll();

        return $this->render('knihy/index.html.twig', [
            'knihy' => $knihy
        ]);
    }
    /**
     * @Route("/new", name="create")
     * @IsGranted("ROLE_USER")
     */
    public function create(Request $request)
    {
        $kniha = new Knihy();

        $form = $this->createForm(KnihaType::class, $kniha);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $file */
            $file = $form->get('obrazek')->getData();
            if($file){
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                try {
                $file->move(
                    $this->getParameter('uploads_dir'),
                    $filename
                );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $kniha->setObrazek($filename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($kniha);
            try {
                $em->flush();
                $this->addFlash('success', 'Kniha úspěšně přidána');
                return $this->redirect($this->generateUrl('knihacreate'));
            } catch (\Exception $exception) {
                dump($kniha);
            }


        }

        return $this->render('knihy/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id}", name="show")
     */
    public function show($id, KnihyRepository $knihyRepository)
    {
        $kniha = $knihyRepository->find($id);
        return $this->render('knihy/show.html.twig', [
            'kniha' => $kniha
        ]);
    }
    /**
     * @Route("/{id}/edit", name="edit")
     * @IsGranted("ROLE_USER")
     */
    public function update($id, Request $request, KnihyRepository $knihyRepository)
    {
        $kniha = new Knihy();


        $knihaVybrana = $knihyRepository->find($id);
        $form = $this->createForm(KnihaEditType::class, $knihaVybrana);
        $starejobrazek = $knihaVybrana->getObrazek();
        $form->get('nazev')->setData($knihaVybrana->getNazev());
        $form->get('author')->setData($knihaVybrana->getAuthor());
        $form->get('detail')->setData($knihaVybrana->getDetail());
        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $file */
            $file = $form->get('obrazek')->getData();

            if($file){
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                try {
                    $file->move(
                        $this->getParameter('uploads_dir'),
                        $filename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $knihaVybrana->setObrazek($filename);
            } else {
                $knihaVybrana->setObrazek($starejobrazek);
            }

            $em = $this->getDoctrine()->getManager();
            try {
                $em->flush();
                $this->addFlash('success', 'Údaje knížky úspěšně změněny');
                return $this->redirect($this->generateUrl('knihaedit'));
            } catch (\Exception $exception) {
                dump($kniha);
            }


        }

        return $this->render('knihy/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @IsGranted("ROLE_USER")
     */
    public function delete($id, KnihyRepository $knihyRepository)
    {
        $kniha = $knihyRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($kniha);
        $em->flush();
        //dodatecna zprava
        $this->addFlash('warning', 'Your post was removed');

        return $this->redirect($this->generateUrl('knihaindex'));
    }

}
