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
use App\Form\SignUpType;
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

    /**
     * @Route("user/signUp", name="signUp", methods={"GET","POST"})
     */
    public function signUp(Request $request, MailerInterface $mailer): Response
    {
        $user = new Utilisateur();

        $form = $this->createForm(SignUpType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository = $this->getDoctrine()->getRepository(Utilisateur::class);
            $verifPassword = $request->request->get('verifPassword');

            // var_dump($verifPassword);
            // var_dump($user->getPassword());

            if($verifPassword != $user->getPassword()){
                $errorMessage = "Vos deux mot de passe ne correspondent pas.";

                return $this->render('user/signup.html.twig', [
                    'form' => $form->createView(),
                    'errorMessage' => $errorMessage,
                ]);
            } else {
                $verifPseudo = $userRepository->testSignUp('pseudo', $user->getUsername());
                if($verifPseudo){
                    $errorMessage = "Ce pseudo existe déjà.";

                    return $this->render('user/signup.html.twig', [
                        'form' => $form->createView(),
                        'errorMessage' => $errorMessage,
                    ]);
                }

                $verifMail = $userRepository->testSignUp('mail', $user->getMailUtilisateur());
                if($verifMail){
                    $errorMessage = "Cet email existe déjà.";

                    return $this->render('user/signup.html.twig', [
                        'form' => $form->createView(),
                        'errorMessage' => $errorMessage,
                    ]);
                }
            }

            // $verifSignup = $userRepository->addUser($user);
            // $idMax = $userRepository->getMaxId();

            $user->setPhotoUtilisateur('NoPicture.jpg');
            $user->setVerifMailUtilisateur(false);
            $roles[] = 'ROLE_USER';
            $user->setRoles($roles);

            $encodedPassword = $this->encoder->encodePassword($user, $user->getPassword());
            $userRepository->upgradePassword($user, $encodedPassword);

            $encodedId = urlencode(base64_encode($user->getId()));

            $email = (new Email())
            ->from('test@gmail.com ')
            ->to($user->getMailUtilisateur())
            ->subject('mail validator')
            ->text('Bonjour'.$user->getUsername().', Veuillez suivre ce lien pour valider votre adresse : http://localhost:8000/emailVal/'.$encodedId.'')
            ->html('<p>Bonjour '.$user->getUsername().', </br>Veuillez suivre ce lien pour valider votre adresse : http://localhost:8000/emailVal/'.$encodedId.'</p>');

            $mailer->send($email);

            return $this->redirectToRoute('home');
        }

        return $this->render('user/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/emailVal/{id}" , name="email_validate", methods={"GET"})
     */
    public function emailVal(Request $request): Response
    {
        var_dump($request->attributes->get('id'));
        $userRepository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $idUser = $request->attributes->get('id');
        $decodedIdUser = (int) base64_decode(urldecode($idUser));

        $userRepository->editMailUser($decodedIdUser);
        return $this->redirectToRoute('home');
    }
}