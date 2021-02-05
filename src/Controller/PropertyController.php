<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;

use App\Form\ContactType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Notification\ContactNotification;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repo;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repo, EntityManagerInterface $em)
    {
        $this->repo=$repo;
        $this->em=$em;
    }
    /**
     * @Route("/biens", name="property.index")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search=new PropertySearch();
        $form=$this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $properties=$paginator->paginate(
            $this->repo->findAllVisibleQuery($search),
        /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        12 /*limit per page*/
        );
        
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

   

    /**
    * @Route("/biens/{slug}-{id}", name="property.show",requirements={"slug":"[a-z0-9\-]*"})
    */
    public function show(Property $property, string $slug, Request $request, ContactNotification $notif): Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }

        $contact=new Contact();
        $contact->setProperty($property);
        $form=$this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notif->notify($contact);
           
            $this->addFlash('success', "Votre email a bien été envoyé");
         
            return $this->redirectToRoute('property.show', [
               'id' => $property->getId(),
               'slug' => $property->getSlug()
            ]);
        }

        
        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
}
