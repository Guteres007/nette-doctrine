<?php

namespace App\Presenters;

use Nette;

use Kdyby\Doctrine\EntityManager;
use App\Model\Article;



class HomepagePresenter extends Nette\Application\UI\Presenter
{

  public $entityManager;

  public function __construct(EntityManager $entityManager)
  {

     $this->entityManager  = $entityManager;

  }



    public function renderDefault()
    {
        $article = $this->entityManager->getRepository(Article::class);
        $this->template->articles = $article->findAll();

    }

}
