<?php

use Symfony\Component\HttpFoundation\Request;
use WinGear\Domain\Comment;
use WinGear\Domain\Article;
use WinGear\Domain\User;
use WinGear\Form\Type\CommentType;
use WinGear\Form\Type\ArticleType;
use WinGear\Form\Type\UserType;
use WinGear\Form\Type\InscriptionType;
use WinGear\Domain\Panier;
use WinGear\Form\Type\PanierType;

// Home page

$app->get('/', function () use ($app) {
    return $app['twig']->render('accueil.html.twig', array());
});


$app->get('/index/', function () use ($app) {
    $articles = $app['dao.article']->findAll();
    return $app['twig']->render('index.html.twig', array('articles' => $articles));
});

// Article details with comments
$app->match('/article/{id}', function ($id, Request $request) use ($app) {
    $article = $app['dao.article']->find($id);
    $user = $app['security']->getToken()->getUser();
    $commentFormView = null;
    if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
        // A user is fully authenticated : he can add comments
        $comment = new Comment();
        $comment->setArticle($article);
        $comment->setAuthor($user);
        $commentForm = $app['form.factory']->create(new CommentType(), $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $app['dao.comment']->save($comment);
            $app['session']->getFlashBag()->add('success', 'Your comment was succesfully added.');
        }
        $commentFormView = $commentForm->createView();
    }
    $comments = $app['dao.comment']->findAllByArticle($id);
    return $app['twig']->render('article.html.twig', array(
                'article' => $article,
                'comments' => $comments,
                'commentForm' => $commentFormView));
});

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
                'error' => $app['security.last_error']($request),
                'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login'); // named route so that path('login') works in Twig templates

// Admin home page
$app->get('/admin', function() use ($app) {
    $articles = $app['dao.article']->findAll();
    $comments = $app['dao.comment']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('admin.html.twig', array(
                'articles' => $articles,
                'comments' => $comments,
                'users' => $users));
});

// Add a new article
$app->match('/admin/article/add', function(Request $request) use ($app) {
    $article = new Article();
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
    }
    return $app['twig']->render('article_form.html.twig', array(
                'title' => 'New article',
                'articleForm' => $articleForm->createView()));
});

// Edit an existing article
$app->match('/admin/article/{id}/edit', function($id, Request $request) use ($app) {
    $article = $app['dao.article']->find($id);
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'The article was succesfully updated.');
    }
    return $app['twig']->render('article_form.html.twig', array(
                'title' => 'Edit article',
                'articleForm' => $articleForm->createView()));
});

// Remove an article
$app->get('/admin/article/{id}/delete', function($id, Request $request) use ($app) {
    // Delete all associated comments
    $app['dao.comment']->deleteAllByArticle($id);
    // Delete the article
    $app['dao.article']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The article was succesfully removed.');
    return $app->redirect('/admin');
});

// Edit an existing comment
$app->match('/admin/comment/{id}/edit', function($id, Request $request) use ($app) {
    $comment = $app['dao.comment']->find($id);
    $commentForm = $app['form.factory']->create(new CommentType(), $comment);
    $commentForm->handleRequest($request);
    if ($commentForm->isSubmitted() && $commentForm->isValid()) {
        $app['dao.comment']->save($comment);
        $app['session']->getFlashBag()->add('success', 'The comment was succesfully updated.');
    }
    return $app['twig']->render('comment_form.html.twig', array(
                'title' => 'Edit comment',
                'commentForm' => $commentForm->createView()));
});

// Remove a comment
$app->get('/admin/comment/{id}/delete', function($id, Request $request) use ($app) {
    $app['dao.comment']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The comment was succesfully removed.');
    return $app->redirect('/admin');
});

// Add a user by admin
$app->match('/admin/user/add', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_form.html.twig', array(
                'title' => 'New user',
                'userForm' => $userForm->createView()));
});

// Inscription
$app->match('/user/add', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new InscriptionType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_new.html.twig', array(
                'title' => 'Inscription',
                'userForm' => $userForm->createView()));
});


// Edit an existing user
$app->match('/admin/user/{id}/edit', function($id, Request $request) use ($app) {
    $user = $app['dao.user']->find($id);
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
    }
    return $app['twig']->render('user_form.html.twig', array(
                'title' => 'Edit user',
                'userForm' => $userForm->createView()));
});
// Remove a user
$app->get('/admin/user/{id}/delete', function($id, Request $request) use ($app) {
// Delete all associated comments
    $app['dao.comment']->deleteAllByUser($id);
// Delete the user
    $app['dao.user']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');
    return $app->redirect('/admin');
});


// List of all categorie
$app->get('/categories/', function() use ($app) {
    $categories = $app['dao.categorie']->findAll();
    return $app['twig']->render('categories.html.twig', array('categories' => $categories));
});



// Display and edit profil
$app->match('/monprofil/', function(Request $request) use ($app) {
    $user = $app['security']->getToken()->getUser();
    $userForm = $app['form.factory']->create(new InscriptionType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
    }
    return $app['twig']->render('user_new.html.twig', array(
                'title' => 'Edit user',
                'userForm' => $userForm->createView()));
});

// Details for a categorie
$app->get('/categorie/{id}', function($id) use ($app) {
    $categorie = $app['dao.categorie']->find($id);
    $articles = $app['dao.article']->findAllCategorie($id);
    return $app['twig']->render('categorie.html.twig', array(
                'categorie' => $categorie,
                'articles' => $articles
    ));
});

// Panier
$app->match('/panier/', function (Request $request) use ($app) {
    $user = $app['security']->getToken()->getUser();
    $id = $user->getId();
    $paniers = $app['dao.panier']->findAllProduct($id);
    
    $articles = $app['dao.article']->findAll();
    return $app['twig']->render('panier.html.twig',array(
        'paniers' => $paniers,
        'articles' => $articles
        
        ));
});

// Ajout dans le panier
$app->match('/addPan/{id}/', function($id, Request $request) use ($app) {  
    $panier = new Panier();
    if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
        $user = $app['security']->getToken()->getUser(); 
        $panierForm = $app['form.factory']->create(new PanierType(), $panier);
        $panierForm->handleRequest($request);
        if ($panierForm->isSubmitted() && $panierForm->isValid()){
            $panier->setId_user($user->getID());
            $panier->setId_product($id);
            $app['dao.panier']->save($panier);
            $app['session']->getFlashBag()->add('success', "L'article a été ajouté");
        
        }
    return $app['twig']->render('panier_form.html.twig',array(
        'title' => 'Ajout au Panier',
        'panierForm' => $panierForm->createView()));  
    
    }});
        
    
    

