<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class PropertyController extends AbstractController
{

  private $repository;

  public function __construct(PropertyRepository $repository)
  {
    $this->repository = $repository;
  }

  #[Route('/property/show/{id}', name: 'property.show')]
  public function show($id): Response
  {
    $property = $this->repository->find($id);
    return $this->render('property/show.html.twig', [
      'property' => $property
    ]);
  }

  #[Route('/properties', name: 'property.index')]
  public function index(PaginatorInterface $paginator, Request $request): Response
  {

    # Déclaration new object PropoertySearch, création du form
    $search = new PropertySearch();
    $form = $this->createForm(PropertySearchType::class, $search);
    $form->handleRequest($request);

    dump($search->getMaxPrice());

    # Envoie toutes les properties not sold via paginator
    # on passe $search a notre requete que fera la traitement
    $properties = $paginator->paginate(
      $this->repository->findAllInSell($search),
      $request->query->getInt('page', 1), /*page number*/
      12
    );

    # envoi du result et du form à la vue
    return $this->render('property/index.html.twig', [
      'properties' => $properties,
      'form' => $form->createView()
    ]);
  }


  #[Route('/property', name: 'property')]
  public function test(ManagerRegistry $doctrine): Response
  {
    // $property = new Property();
    // $property->setTitle('Mon premier bien')
    //   ->setPrice(200000)
    //   ->setRooms(4)
    //   ->setBedrooms(3)
    //   ->setDescription('jolie bien')
    //   ->setSurface(60)
    //   ->setFloor(4)
    //   ->setHeat(1)
    //   ->setCity('Montpellier')
    //   ->setAddress('bvd Gambetta');

    // # appel de l'entity manager, qui possède la method persist
    // $entityManager = $doctrine->getManager();
    // $entityManager->persist($property);
    // # method flush porte tout les changement en db
    // $entityManager->flush();

    //$properties =  $this->repository->find(id: 1);
    $properties =  $this->repository->findOneBy(['floor' => 4, 'rooms' => 4]);
    // appel une fonction definie dans le repository / le result d'une query
    #$properties =  $this->repository->findAllInSell();

    dump($properties);

    return $this->render('property/index.html.twig', [
      'controller_name' => 'PropertyController',
    ]);
  }
}
