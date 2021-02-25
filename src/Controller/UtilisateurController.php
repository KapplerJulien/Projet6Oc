<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Form\EmailPasswordType;
use App\Form\EditPasswordType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurController extends AbstractController 
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @Route("user/emailEditPassword" , name="email_edit_password")
     */
    public function emailEditPassword(Request $request, MailerInterface $mailer): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(EmailPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository = $this->getDoctrine()->getRepository(Utilisateur::class);
            $userEditPass = $userRepository->getUserByEmail($user->getMailUtilisateur());

            $encodedId = urlencode(base64_encode($userEditPass[0]->getId()));

            $email = (new Email())
            ->from('test@gmail.com ')
            ->to($userEditPass[0]->getMailUtilisateur())
            ->subject('Reset mot de passe')
            ->text('Bonjour '.$userEditPass[0]->getUsername().', Veuillez suivre ce lien pour changer votre motDePasse : http://localhost:8000/editPassword/'.$encodedId.'')
            ->html('<p>Bonjour '.$userEditPass[0]->getUsername().', </br>Veuillez suivre ce lien pour changer votre motDePasse : http://localhost:8000/editPassword/'.$encodedId.'</p>');

            $mailer->send($email);

            return $this->redirectToRoute('home');
        }

        return $this->render('user/emailEditPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/editPassword/{id}" , name="edit_password")
     */
    public function editPassword(Request $request): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(EditPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository = $this->getDoctrine()->getRepository(Utilisateur::class);
            $verifPassword = $request->request->get('verifPassword');

            if($verifPassword != $user->getPassword()){
                $errorMessage = "Vos deux mot de passe ne correspondent pas.";

                return $this->render('user/editPassword.html.twig', [
                    'form' => $form->createView(),
                    'errorMessage' => $errorMessage,
                ]);
            }
            $idUser = $request->attributes->get('id');
            $encodedPassword = $this->encoder->encodePassword($user, $user->getPassword());
            $decodedIdUser = (int) base64_decode(urldecode($idUser));
            $userRepository->setPasswordUser($decodedIdUser, $encodedPassword);

            return $this->redirectToRoute('home');
        }

        return $this->render('user/editPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}