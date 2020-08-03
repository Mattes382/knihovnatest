<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use App\Repository\KnihyRepository;
use App\Repository\UserRepository;
use App\Repository\ZanryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/admin", name="admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
    /**
     * @Route("/knihy", name="kniha")
     */
    public function kniha(KnihyRepository $knihyRepository)
    {

            $knihy =  $knihyRepository->findAll();

        return $this->render('admin/knihy.html.twig', [
            'knihy' => $knihy
        ]);
    }
    /**
     * @Route("/author", name="author")
     */
    public function author(AuthorRepository $authorRepository)
    {

        $author = $authorRepository->findAll();

        return $this->render('admin/author.html.twig', [
            'authori' => $author
        ]);
    }
    /**
     * @Route("/user", name="user")
     */
    public function user(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        return $this->render('admin/users.html.twig',[
            'users' => $users
        ]);
    }
    /**
     * @Route("/zanr", name="zanr")
     */
    public function zanr(ZanryRepository $zanryRepository)
    {
        $zanry = $zanryRepository->findAll();
        return $this->render('admin/zanr.html.twig',[
            'zanry' => $zanry
        ]);
    }
}
