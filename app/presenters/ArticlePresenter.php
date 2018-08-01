<?php

namespace App\Presenters;

use Nette;

use Kdyby\Doctrine\EntityManager;
use App\Model\Article;
use App\Model\Slug;



class ArticlePresenter extends Nette\Application\UI\Presenter
{

  private $entityManager;

  public function __construct(EntityManager $EntityManager)
  {
    $this->entityManager = $EntityManager;
  }


  public function renderNew()
  {
      $article = new Article();
      $slug = new Slug();

      $article->setTitle("eee");
      $article->setBody("00000");
      $article->setSlug($slug);

      $slug->setArticle($article);
      $slug->setName("jmeno-slugu-".rand(100, 99999));


      $this->entityManager->persist($article);
     // $this->entityManager->persist();
      $this->entityManager->flush();

  }








  public function renderShow($id)
  {
     $article = $this->entityManager->getRepository(Article::class);
        $this->template->article = $article->find($id);
  }


}
