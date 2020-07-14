<?php
namespace App\Controller\Admin;

use App\Entity\Demandes;
use App\Repository\DemandesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeController extends AbstractController{

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var DemandesRepository
     */
    private $demande;

    public function __construct(DemandesRepository $demande, EntityManagerInterface $em)
    {
        $this->demande=$demande;
        $this->em = $em;
    }

    /**
    * @Route("/admin",name="admin.demande.index")
    * @return Response
    */
    public function index(): Response
    {
        $demandes = $this->demande->findAll();
        return $this->render('admin/demande/index.html.twig', [
            "demandes" => $demandes
        ]);

    }

    /**
     * @Route("/admin/demande/{slug}-{id}", name="admin.demande.show", requirements={"slug" : "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Demandes $demandes, string $slug):Response{
        if($demandes->getSlug() !== $slug){
            return $this->redirectToRoute('demande.error');
        }
        return $this->render('admin/demande/show.html.twig', [
            'demande'=> $demandes,
            'current_menu'=>'demandes'
        ]);

    }

    /**
     * @Route("/admin/demande/{id}", name="admin.demande.lecture", methods="POST")
     * @param Demandes $demande
     * @param Request $request
     * @return RedirectResponse
     */
    public function lecture(Demandes $demande, Request $request){

        if($demande->isLu()){
            $demande->setLu(false);
        }else{
            $demande->setLu(true);
        }
        if($this->isCsrfTokenValid('update'  . $demande->getId(), $request->get('_token_update'))){
            $this->em->persist($demande);
            $this->em->flush();
        }

        return $this->redirectToRoute('admin.demande.index');


    }

    /**
     * @Route("/admin/demande/{id}", name="admin.demande.delete", methods="DELETE")
     * @param Demandes $demandes
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Demandes $demandes, Request $request){
        if($this->isCsrfTokenValid('delete'  . $demandes->getId(), $request->get('_token'))){
            $this->em->remove($demandes);
            $this->em->flush();
            $this->addFlash('success', 'Supprimé avec succès');
        }
        return $this->redirectToRoute('admin.demande.index');

    }

}