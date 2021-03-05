<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
  /**
   * @Route("/library/list", name="library_list" )
   */
  public function list(Request $request, LoggerInterface $logger)
  {
    $title = $request->get('title','xde');
    $logger->info('list action called');
    $response = new JsonResponse();
    $response->setData([
      'success' => true,
      'data' => [
        [
          'id' => 1,
          'title' => 'kalilinux'
        ],
        [
          'id' => 2,
          'title' => 'kalilinux'
        ],
        [
          'id' => 3,
          'title' => $title
        ]
      ]
    ]);
    return $response;
  }
  /**
   * @Route("/book/create", name="create_book" )
   */

  public function createBook(Request $request, EntityManagerInterface $em){
    $book = new Book();
    $title = $request->get('title', null);
    if (empty($title)){
      $response = new JsonResponse();
      $response->setData([
        'success' => false,
        'error' => 'title cannot be empy',
        'data' => [
          [
            'id' => $book->getId(),
            'title' => $book->getTitle()
          ]
        ]
      ]);
      return $response;
    }
    $book->setTitle();
    $em->persist($book);
    $em->flush();
  }
}