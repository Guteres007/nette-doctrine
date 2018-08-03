<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Slug
{


 /**
     * One SLug has One Article.
     * @ORM\OneToOne(targetEntity="Article", mappedBy="slug",cascade={"persist"})
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id",nullable=true,onDelete="SET NULL")
     */
    private $article;

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue
   */
  private $id;

  /**
   * @ORM\Column(type="string", unique=true)
   */
  private $name;



   public function getName()
   {
    return $this->name;
   }


   public function setName($name)
   {
     $this->name = $name;
   }

   public function setArticle(Article $article)
   {
     $this->article = $article;
   }

    public function getArticle()
   {
       return $this->article;
   }
}
