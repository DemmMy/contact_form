<?php
namespace App\Controller;


use App\Entity\Demandes;
use App\Form\DemandeType;
use App\Repository\DemandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeUtilisateurController extends AbstractController{
    /**
     * @var DemandesRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * DemandeUtilisateurController constructor.
     * @param DemandesRepository $repository
     * @param EntityManagerInterface $em
     */

    public function __construct(DemandesRepository $repository, EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }



    /**
     * @Route("/", name="demande.new")
     */
    public function new(Request $request):Response{
        $demande = new Demandes();
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($demande);
            $this->em->flush();
            $this->addFlash('success', 'Demande envoyée avec succès');
            return $this->redirectToRoute('demande.new');
        }
        return $this->render('demande/new.html.twig', [
            'form'=>$form->createView()
        ]);
    }



    /**
     * @Route ("/errors", name="demande.error")
     * @return Response
     */
    /*public function error():Response{
        return $this->render('errors/urlerror.html.twig');
    }*/

}