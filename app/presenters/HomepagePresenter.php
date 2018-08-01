<?php

namespace App\Presenters;

use Nette;

use Kdyby\Doctrine\EntityManager;
use App\Model\Article;



class HomepagePresenter extends Nette\Application\UI\Presenter
{

  public $entityManager;
  public $article;

  public function __construct(EntityManager $entityManager, Article $article)
  {

     $this->entityManager  = $entityManager;
     $this->article  = $article;

  }



    public function renderDefault()
    {

        $this->template->articles = $this->article->getAllArticles();

    }

}
