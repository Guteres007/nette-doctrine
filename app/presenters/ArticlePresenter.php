<?php

namespace App\Presenters;
use Nette\Application\UI;
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

  }


  public function renderShow($id)
  {
     $article = $this->entityManager->getRepository(Article::class);
        $this->template->article = $article->find($id);
  }


  public function createComponentCreateArticleForm()
  {
    $form = new UI\Form;
    $form->addText('title', 'Title:')->setRequired('Zadejte prosím Title');
    $form->addText('body', 'Body:')->setRequired('Zadejte prosím Body');
    $form->addText('slug', 'Slug:')->setRequired('Zadejte prosím Slug');
    $form->addSubmit('submit', 'Vytvořit Article');
    $form->onSuccess[] = [$this, 'articleFormSucceeded'];
    return $form;
  }

      // volá se po úspěšném odeslání formuláře
    public function articleFormSucceeded(UI\Form $form, $values)
    {
       $article = new Article();
       $slug = new Slug();

       $article->setTitle($values->title);
       $article->setBody($values->body);
       $article->setSlug($slug);

       $slug->setArticle($article);
       $slug->setName($values->slug);


       $this->entityManager->persist($article);
       $this->entityManager->flush();

       $this->flashMessage('Článek přidán.');
       $this->redirect('Homepage:');
    }
}
