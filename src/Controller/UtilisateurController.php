<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UtilisateurController extends AbstractController 
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("user/connect", name="login")
     */
    public function connect(Request $request): Response
    {
        // Nous créons l'instance de "Utilisateur"
        $utilisateur = new Utilisateur();

        // Nous créons le formulaire en utilisant "ConnectionType" et on lui passe l'instance
        $form = $this->createForm(UtilisateurType::class, $utilisateur);

        // Nous récupérons les données
        $form->handleRequest($request);

        // Nous vérifions si le formulaire a été soumis et si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {
                $userRepository = $this->getDoctrine()->getRepository(Utilisateur::class);

                $utilisateurBDD = $userRepository->connection($utilisateur->getPseudoUtilisateur() ,$utilisateur->getMdpUtilisateur());


                if(!empty($utilisateurBDD)){
                    // $id = $utilisateurBDD->getId();
                    // var_dump($pseudo);
                    // var_dump($id);
                    $id = $utilisateurBDD[0];
                    $this->session->set('userId',$id);

                    return $this->redirectToRoute('home');
                }

        }

        return $this->render('user/connect.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("user/logout", name="logout")
     */
    public function logout(){
        $this->session->clear();
        return $this->redirectToRoute('home');
    }
}