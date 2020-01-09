<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; 
use App\Form\ReponseFormType; 
use App\Form\AjoutTopicFormType;
use App\Entity\Reponse;
use App\Entity\Topic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class TopicController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        $topics = $this->getDoctrine()->getRepository(Topic::class)->findAll();
        return $this->render('topic/index.html.twig', [
            'topic' => $topics,
        ]);
    }

    /**
     * @Route("/topic/{id}", name="article")
     */
    public function topic($id, Request $request)
    {
        $topics = $this->getDoctrine()->getRepository(Topic::class)->findOneBy([
            'id' => $id
        ]);
        if(!$topics) {
            throw $this->createNotFoundException("Ce topic n'existe pas");
        }

        $reponse = new Reponse();
        $form = $this->createForm(ReponseFormType::class, $reponse);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $reponse->setTopic($topics);
            $reponse->setAuteur($this->getUser());
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($reponse);
            $doctrine->flush();
        }  
         return $this->render('topic/topic.html.twig', [
            'topic' => $topics,
            'commentForm' => $form->createView()
        ]);
    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route("/topicadd", name="ajout_article")
     */
    
     public function ajout(Request $request)
    {
        $topic = new Topic();

        $form = $this->createForm(AjoutTopicFormType::class, $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $topic->setAuteur($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($topic);
            $entityManager->flush();

            $this->addFlash('message', 'Article ajouté avec succès');
            return $this->redirectToRoute('accueil');
        }        


        
        return $this->render('topic/ajout.html.twig', [
            'topicForm' => $form->createView(),
        ]);
    }
        


     


}
