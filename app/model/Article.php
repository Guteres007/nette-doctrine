<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\EntityManager;

/**
 * @ORM\Entity
 */
class Article
{



   public $entityManager;

  public function __construct(EntityManager $entityManager)
  {

     $this->entityManager  = $entityManager;

  }






 /**
     * One Article has One Slug.
     * @ORM\OneToOne(targetEntity="Slug", mappedBy="article",cascade={"persist"})
     * @ORM\JoinColumn(name="slug_id", referencedColumnName="id",nullable=true,onDelete="SET NULL")
     */
    private $slug;


  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue
   */
  private $id;

  /**
   * @ORM\Column(type="string")
   */
  private $title;

    /**
   * @ORM\Column(type="text")
   */
  private $body;


  public function getBody()
  {
    return $this->body;
  }

public function getTitle()
  {
     return $this->title;
  }


  public function setBody($body)
  {
    $this->body = $body;
  }

public function setTitle($title)
  {
      $this->title = $title;
  }

public function setSlug( Slug $slug)
  {
      $this->slug = $slug;
  }

public function getSlug()
  {
      return $this->slug;
  }

 public function getId()
 {
   return $this->id;
 }

 public function getAllArticles()
 {
   return $this->entityManager->getRepository(Article::class)->findAll();
 }

}
