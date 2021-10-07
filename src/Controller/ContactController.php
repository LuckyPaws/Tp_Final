<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $formulaire = $this->createForm(ContactType::class);
        $formulaire->handleRequest($request);

        $notif = '';

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $data = $formulaire->getData();

            $email = new Email;
            $email
                ->from('test@hotmail.fr')
                ->to('linkot2015@gmail.com')
                ->subject($data['objet'])
                ->text('On vous a envoyé un message. Voici ce qu\'il disait :'
                    . PHP_EOL . PHP_EOL .
                    $data['message']
                    . PHP_EOL . PHP_EOL .
                    'Cet email vous a été envoyé par une boîte automatique.'
                    . PHP_EOL .
                    'Si vous souhaitez répondre à cette personne, veuillez lui écrire à l\'adresse test@hotmail.fr ou encore utiliser le bouton "Répondre".');

            $mailer->send($email);

            $notif = 'Votre message à bien été envoyé';
        }

        return $this->render(
            'contact.html.twig',
            [
                'notif' => $notif,
                'formulaire' => $formulaire->createView(),
            ]
        );
    }
}
