<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{

  private $repository;


  public function __contruct(PropertyRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * return all property, sold or not
   */
  #[Route('/admin/properties', name: 'admin.property.index')]
  public function index(ManagerRegistry $doctrine)
  {
    $properties = $doctrine->getRepository(Property::class)->findall();
    return $this->render('admin/index.html.twig', [
      'properties' => $properties
    ]);
  }

  #[Route('/admin/property/new', name: 'admin.property.new')]
  public function new(Request $request, ManagerRegistry $doctrine)
  {
    $property = new Property;
    $form =  $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $doctrine->getManager();
      $entityManager->persist($property);
      $entityManager->flush();
      $this->addFlash('success', 'le bien a correctement été créé');
      return $this->redirectToRoute('admin.property.index');
    }

    return $this->render('admin/new.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }

  /**
   * allow admin to edit property
   */
  #[Route('/admin/property/edit/{id}', name: 'admin.property.edit', methods: 'GET|POST')]
  public function edit(Property $property, Request $request, ManagerRegistry $doctrine)
  {
    $form =  $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $doctrine->getManager();
      $entityManager->flush();
      $this->addFlash('success', 'le bien a correctement été modifié');
      return $this->redirectToRoute('admin.property.index');
    }

    return $this->render('admin/edit.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }


  /**
   * Delete property by id
   */
  #[Route('/admin/property/delete/{id}', name: 'admin.property.delete')]
  public function delete(Property $property, Request $request, ManagerRegistry $doctrine)
  {
    $entityManager = $doctrine->getManager();
    $entityManager->remove($property);
    $entityManager->flush();
    return $this->redirectToRoute('admin.property.index');
  }
}
