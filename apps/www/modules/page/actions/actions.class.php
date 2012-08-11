<?php

class pageActions extends sfActions
{
	const title_prefix = 'Blog - ';

	public function preExecute() {
		sfConfig::set('sf_escaping_strategy', false);  
		sfContext::getInstance()->getConfiguration()->loadHelpers('Text', 'I18n', 'Post');
		sfContext::getInstance()->getResponse()->addMeta('image_src', 'http://'.$_SERVER['SERVER_NAME'].'/images/image_src.jpg');
	}

	public function executeBot(sfWebRequest $request) {
		$bot = new Bot();
		$bot->setUrl($_SERVER['REQUEST_URI']);
		$bot->setIp($_SERVER['REMOTE_ADDR']);
		$bot->setTrace(sfYaml::dump(array(
			'SERVER' => $_SERVER,
			'POST' => $_POST,
			'GET' => $_GET,
			'COOKIE' => $_COOKIE
		)));
		$bot->save();
	}

  public function executeIndex(sfWebRequest $request) {
		if($date = $request->getParameter('date')) {
			$date = date('Y/m/d H:i:s', $date);
			$criteria = new Criteria();
			$criteria->addAnd(PostPeer::PUBLISHED_AT, $date);
			$old_post = PostPeer::doSelectOne($criteria);
			if($old_post) {
				$this->redirect('@post?id='.$old_post->getId().'&slugy_path='.$old_post->getSlugyPath());
			}
		}

		$pager = new sfPropelPager('Post', 5);
		$pager->setPage($request->getParameter('page', 1));

		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn(PostPeer::PUBLISHED_AT);
		$criteria->addAnd(PostPeer::IS_ACTIVE, true);
		$criteria->addJoin(PostHasCategoryPeer::POST_ID, PostPeer::ID);
		$criteria->addJoin(CategoryPeer::ID, PostHasCategoryPeer::CATEGORY_ID);	
		$criteria->addAnd(CategoryPeer::IS_ACTIVE, true);
		$criteria->setDistinct();

		$pager->setCriteria($criteria);	

		$pager->init();

		if(!$pager->getResults()) {
			$this->forward404();
		}

		sfContext::getInstance()->getResponse()->addMeta('title', self::title_prefix.'Accueil');

		$this->current_page = $request->getParameter('page', 1);
		$this->next_page = $pager->getNextPage();
		$this->pager = $pager;
	}

	public function executeContact(sfWebRequest $request) {
		sfContext::getInstance()->getResponse()->addMeta('title', self::title_prefix.'Contact');

		$form = new ContactForm();

		$this->sent = $request->getParameter('sent') == 'envoye';

		if($request->isMethod('post')) {
			$form->bind($request->getParameter('contact'));

			if($form->isValid()) {
				$template = 'contact_email';

				$datas = $request->getParameter('contact');

				$mailer = $this->getMailer();

				$subject = $form->getSubjects();
				$subject = $subject[$datas['subject']];

				unset($datas['subject']);

				$mailBody = $this->getPartial($template, array(
					'datas' => $datas,
					'subject' => $subject
				));				

				$message = Swift_Message::newInstance()
						->setFrom(array('no-reply@deblan.fr'))
						->setTo('simon@deblan.fr')
						->setSubject($subject)
						->setBody($mailBody, 'text/html');

				$mailer->sendNextImmediately()->send($message);

				$this->redirect('@contact?sent=envoye');
			}
		}

		$this->form = $form;
	}

	public function executeMinecraft(sfWebRequest $request) {
		sfContext::getInstance()->getResponse()->addMeta('title', self::title_prefix.'Minecraft');

		$criteria = new Criteria();
		$criteria->addAnd(PostPeer::TITLE, 'page:minecraft');
		$post = PostPeer::doSelectOne($criteria);
		$this->forward404Unless($post);


		$form = new CommentFrontForm();

		if($this->processPostCommentForm($request, $post, $form)) {
			$this->redirect('@minecraft');
		}

		$this->form = $form;
		$this->post = $post;
		$this->sent = $request->getParameter('sent') > 0;
	}

	public function executeMinecraftAjax(sfWebRequest $request) {
		$mem = new Memcached();
		$mem->addServer('localhost', 11211);


		if($info = $mem->get('minecraft_server_info')) {
			echo $info;
			return sfView::NONE;
		}

		$info = array(
			'up'     => true,
			'online' => 0,
			'places' => 20
		);

		$socket = @fsockopen('play.deblan.fr', 25565);

		if($socket) {
			fwrite($socket, "\xFE");
			$data = fread($socket, 1024);
			fclose($socket);

			if($data &&  substr($data, 0, 1) == "\xFF") {
				$_info = explode(
					"\xA7", 
					mb_convert_encoding(
						substr($data, 1), 
						"iso-8859-1", 
						"utf-16be"
					)
				);
			
				/*$serverName = substr($info[0], 1);
				$playersOnline = $info[1];
				$playersMax = $info[2];*/

				$info['online'] = $_info[1];
				$info['places'] = $_info[2];
			}
		}
		else {
			$info['up'] = false;
		}

		$json_info = json_encode($info);

		$mem->set('minecraft_server_info', $json_info, 60*5);

		echo $json_info;

		return sfView::NONE;
	}

	public function executeSharePost(sfWebRequest $request) {
		$post = PostPeer::retrieveByPK($request->getParameter('id'));
		$this->forward404Unless($post);	

		if($request->getParameter('slugy_path') != $post->getSlugyPath()) {
			$this->redirect('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath());
		}


		sfContext::getInstance()->getResponse()->addMeta('title', self::title_prefix.$post->getTitle());
		sfContext::getInstance()->getResponse()->addMeta('image_src', $post->getPicture());
		sfContext::getInstance()->getResponse()->addMeta('description', textToMetaDescription($post->getContent()));
		sfContext::getInstance()->getResponse()->addMeta('image_src', $post->getPicture());

		echo $this->getPartial('sharePost', array('post' => $post));
		return sfView::NONE;
	}

	public function processPostCommentForm(sfWebRequest $request, Post $post, CommentFrontForm &$form) {
		if($request->isMethod('post')) {
			$datas = $request->getParameter($form->getName());
			$form->bind($datas);
		
			if($form->isValid()) {
				$form->getObject()->setPostId($post->getId());
				$form->getObject()->setIp($_SERVER['REMOTE_ADDR']);
				$form->save();

				$template = 'comment_email';

				$mailBody = $this->getPartial($template, array(
					'post' => $post,
					'comment' => $form->getObject()
				));

				$mailer = $this->getMailer();

				$subject = "Nouveau commentaire";

				$message = Swift_Message::newInstance()
						->setFrom(array('no-replay@deblan.fr'))
						->setTo('simon@deblan.fr')
						->setSubject($subject)
						->setBody($mailBody, 'text/html');

				$mailer->sendNextImmediately()->send($message);

				return true;
			}
		}

		return false;
	}

	public function executePost(sfWebRequest $request) {		
		$post = PostPeer::retrieveByPK($request->getParameter('id'));
		$this->forward404Unless($post);


		if($request->getParameter('slugy_path') != $post->getSlugyPath()) {
			$this->redirect('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath());
		}

		$form = new CommentFrontForm();

		if($this->processPostCommentForm($request, $post, $form)) {
			$this->redirect('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath().'&sent=1#top');
		}
			
		sfContext::getInstance()->getResponse()->addMeta('title', self::title_prefix.$post->getTitle());
		sfContext::getInstance()->getResponse()->addMeta('image_src', $post->getPicture());
		sfContext::getInstance()->getResponse()->addMeta('description', textToMetaDescription($post->getContent()));
		sfContext::getInstance()->getResponse()->addMeta('image_src', $post->getPicture());

		$this->form = $form;
		$this->post = $post;
		$this->sent = $request->getParameter('sent') > 0;
	}

	public function executeCategory(sfWebRequest $request) {
		$this->category = CategoryPeer::retrieveByPK($request->getParameter('id'));

		$this->forward404Unless($this->category);

		if($request->getParameter('slugy_path') != $this->category->getSlugyPath()) {
			$this->redirect('@category?id='.$this->category->getId().'&page='.$request->getParameter('page').'&slugy_path='.$this->category->getSlugyPath());
		}

		sfContext::getInstance()->getResponse()->addMeta('title', self::title_prefix.$this->category->getName());

		$pager = new sfPropelPager('Post', 5);
		$pager->setPage($request->getParameter('page', 1));

		$criteria = new Criteria();
		$criteria->addAnd(PostPeer::IS_ACTIVE, true);
		$criteria->addJoin(PostHasCategoryPeer::POST_ID, PostPeer::ID);
		$criteria->addDescendingOrderByColumn(PostPeer::PUBLISHED_AT);
		$criteria->addAnd(PostHasCategoryPeer::CATEGORY_ID, $request->getParameter('id'));
		$criteria->addJoin(CategoryPeer::ID, PostHasCategoryPeer::CATEGORY_ID);
		$criteria->addAnd(CategoryPeer::IS_ACTIVE, true);
		$pager->setCriteria($criteria);
		
		$pager->init();

		$this->current_page = $request->getParameter('page', 1);
		$this->next_page = $pager->getNextPage();
		$this->pager = $pager;		
	}

	public function executeTag(sfWebRequest $request) {
		$tag = $request->getParameter('tag');

		$pager = new sfPropelPager('Post', 5);
		$pager->setPage($request->getParameter('page', 1));

		$criteria = new Criteria();
		$criteria->addAnd(PostPeer::IS_ACTIVE, true);
		$criteria->addDescendingOrderByColumn(PostPeer::PUBLISHED_AT);
		$criteria->addJoin(PostHasCategoryPeer::POST_ID, PostPeer::ID);
		$criteria->addJoin(CategoryPeer::ID, PostHasCategoryPeer::CATEGORY_ID);	
		$criteria->addAnd(CategoryPeer::IS_ACTIVE, true);
		$criteria->add(PostPeer::TAGS, '%'.str_replace('%', '', $tag).'%', Criteria::LIKE);
		$criteria->setDistinct();

		$pager->setCriteria($criteria);	

		$pager->init();

		sfContext::getInstance()->getResponse()->addMeta('title', self::title_prefix.'#'.$tag);

		$this->tag = $tag;
		$this->current_page = $request->getParameter('page', 1);
		$this->next_page = $pager->getNextPage();
		$this->pager = $pager;	
		$this->has_results = $pager->getResults();
	}

	public function executeSearch(sfWebRequest $request) {
		$keywords = explode(' ', str_replace('%', '', $request->getParameter('query', '')));
		
		$criteria = new Criteria();
		$criteria->addAnd(PostPeer::IS_ACTIVE, true);
		$criteria->addDescendingOrderByColumn(PostPeer::PUBLISHED_AT);
		$criteria->addJoin(PostHasCategoryPeer::POST_ID, PostPeer::ID);
		$criteria->addJoin(CategoryPeer::ID, PostHasCategoryPeer::CATEGORY_ID);	
		$criteria->addAnd(CategoryPeer::IS_ACTIVE, true);
		$criteria->setDistinct();

		$empty = true;
		foreach($keywords as $k => $v) {
			if(!empty($v)) {
				$empty = false;
				//$criteria->addOr(PostPeer::TITLE, '%'.$v.'%', Criteria::LIKE);
				$criteria->addOr(PostPeer::CONTENT, '%'.$v.'%', Criteria::LIKE);
			}
		}

		if($empty) {
			$this->redirect('@homepage');
		}

		sfContext::getInstance()->getResponse()->addMeta('title', self::title_prefix.' Recherche : '.$request->getParameter('query'));

		$pager = new sfPropelPager('Post', 5);
		$pager->setPage($request->getParameter('page', 1));
		$pager->setCriteria($criteria);	

		$pager->init();

		$this->current_page = $request->getParameter('page', 1);
		$this->next_page = $pager->getNextPage();
		$this->pager = $pager;	
		$this->search = $request->getParameter('query');
		$this->has_resultats = $pager->getResults();
	}

	public function executeProfile(sfWebRequest $request) {
		$username = $request->getParameter('username');

		$criteria = new Criteria();
		$criteria->addAnd(sfGuardUserPeer::USERNAME, $username);
		
		$user = sfGuardUserPeer::doSelectOne($criteria);

		$this->forward404Unless($user);

		$this->user = $user;
	}

	public function executeAccount(sfWebRequest $request) {
		if(!$this->getUser()->isAuthenticated()) {
			$this->redirect('@auth');
		}
		
		$form = new sfGuardUserAdminFrontForm($this->getUser()->getGuardUser());

		if($request->isMethod('post')) {
			$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

			if($form->isValid()) {
				$form->save();
				$this->redirect('@account?sent=1');
			}
		}

		$this->form = $form;
		$this->sent = $request->getParameter('sent') > 0;
	}

	public function executeAuth(sfWebRequest $request) {
		if($_SERVER['SERVER_PORT'] != 443) {
			$this->redirect('https://'.$_SERVER['SERVER_NAME'].$this->getContext()->getController()->genUrl('@auth'));
		}

		$form = new sfGuardFormSignin();
		$failed = false;

		if($request->getParameter('logout') && $this->getUser()->isAuthenticated()) {
			$this->getUser()->signOut();
		}

		if($request->isMethod('post')) {
			$form->bind($request->getParameter($form->getName()));

			if($form->isValid()) {
				$values = $form->getValues();
				$this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);
				$this->redirect('@homepage');
			}

			$failed = true;
		}

		$this->failed = $failed;
		$this->form = $form;
	}

	public function executeError404(sfWebRequest $request) {
	
	}

/*
	public function executeImport(sfWebRequest $request) {
		$con = Propel::getConnection();
		$stmt = $con->prepare('select * from billets');
		$stmt->execute();
		$posts = $stmt->fetchAll();

		foreach($posts as $k => $v) {
			$p = new Post();
			$p->setTitle($v['titre']);
			$p->setContent($v['texte']);
			$p->setPicture($v['image']);
			$p->setTitle($v['titre']);
			$p->setUserId(1);
			$p->setTags($v['tags']);

			$date = ($v['date']);

			$p->setPublishedAt($date);
			$p->setCreatedAt($date);
			$p->setUpdatedAt($date);

			$p->save();

			$stmt = $con->prepare('select * from categories where idc='.$v['categorie']);
			$stmt->execute();
			$cat = $stmt->fetchAll();

			$lcat = CategoryPeer::retrieveByName($cat[0]['nom_categorie']);

			if(!$lcat) {
				$lcat = new Category();
				$lcat->setRank($cat[0]['place_categorie']);
				$lcat->setName($cat[0]['nom_categorie']);
				$lcat->save();
			}
			else {
				$phc = new PostHasCategory();
				$phc->setPostId($p->getId());
				$phc->setCategoryId($lcat->getId());
				$phc->save();
			}

			$stmt = $con->prepare('select * from commentaires where idbi='.$v["id"]);
			$stmt->execute();
			$comments = $stmt->fetchAll();

			foreach($comments as $u => $x) {
				$c = new Comment();
				$c->setPostId($p->getId());
				$c->setAuthor($x['pseudo']);
				$c->setContent($x['commentaire']);
				$c->setEmail($x['courriel']);
				$c->setWebsite($x['internet']);
				$c->setIp($x['ip']);
				
				$date = intval($x['date']);

				$c->setCreatedAt($date);
				$c->setUpdatedAt($date);

				$c->save();
			}
		}
	}
*/
}
