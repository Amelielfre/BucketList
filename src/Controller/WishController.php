<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\VoeuxType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wish", name="app_wish_")
 */
class WishController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(WishRepository $wishRepo, Request $request): Response
    {
        $wishes = $wishRepo->findBy(["isPublished" => true], ["dateCreated" => "desc"]);

        return $this->render('wish/list.html.twig', ["wishes" => $wishes]);
    }

    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function detail(WishRepository $wishRepo, $id): Response
    {
        $wish = $wishRepo->find($id);
        return $this->render('wish/detail.html.twig', compact("wish"));
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function add(WishRepository $wishRepo, Request $request): Response
    {
        $wish = new Wish();
      if($this->getUser()){
           $wish->setAuthor($this->getUser()->getPseudo());
        }
        $formWish = $this->createForm(VoeuxType::class, $wish);
        $formWish->handleRequest($request);

        if ($formWish->isSubmitted() && $formWish->isValid()) {
            $wishRepo->add($wish, true);
            return $this->redirectToRoute("app_wish_detail", ["id" => $wish->getId()]);
        }


        return $this->render('wish/add.html.twig',["formWish" => $formWish->createView()]);
    }


    /**
     * @Route("/supp", name="app_supp_wish")
     */

    public function removeBook(WishRepository $wishRepository, Request $request): Response
    {
        $submittedToken = $request->request->get("token");

        if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {
            $wish = $wishRepository->find($request->request->get("id"));
            $wishRepository->remove($wish);
        }

        return $this->json($this->isCsrfTokenValid('delete-item', $submittedToken));

    }
}
