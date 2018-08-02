<?php

namespace App\Presenters;
use Nette\Application\UI;
use Nette;

use Kdyby\Doctrine\EntityManager;
use Doctrine\ORM\Query;
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


  public function actionUpdate($id)
  {
   $article = $this->entityManager->getRepository(Article::class);
   $article = $article->find($id);
   // dump([$article->getTitle(),$article->getBody(),$article->getSlug()]);
   $this['createArticleForm']->setDefaults([
    "title"=>$article->getTitle(),
    "body"=>$article->getBody(),
    "slug"=>$article->getSlug()->getName()
  ]);
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

       //bere z actionUpdate($id) idéčko
       $articleId = $this->getParameter('id');
       if ($articleId)
       {
         $article = $this->entityManager->getRepository(Article::class);
         $article = $article->find($articleId);

         $article->setTitle($values->title);
         $article->setBody($values->body);
         $article->getSlug()->setName($values->slug);
         $this->entityManager->persist($article);
         $this->entityManager->flush();
         $this->flashMessage('Článek updatován.');
         $this->redirect('Homepage:');

       }else{


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
}
