<?php
	
class pageComponents extends sfComponents {
	public function executeSide(sfWebRequest $request) {
		$criteria = new Criteria();
		$criteria->addAnd(CategoryPeer::IS_ACTIVE, true);
		$this->categories = CategoryPeer::getAllByRank($criteria);
		$this->links = LinkPeer::getAllByRank();
		$this->comments = CommentPeer::getLastComments();
	}

	public function executeTop(sfWebRequest $request) {
		$this->query = $request->getParameter('query', '');
	}

	public function executeShowPost(sfWebRequest $request) {
		
	}

	public function executeShowComment(sfWebRequest $request) {
		if(empty($this->level)) {
			$this->level = 1;
		}
	}
}
