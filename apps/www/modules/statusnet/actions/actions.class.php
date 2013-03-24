<?php

/**
 * statusnet actions.
 *
 * @package    deblantv
 * @subpackage statusnet
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class statusnetActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $last_status = null;
    $xml         = simplexml_load_file('http://statusnet.deblan.org/index.php/api/statuses/user_timeline/1.rss');
    $xpath       = '/rss/channel/item/description';
    $elements    = $xml->xpath($xpath);
	$username    = 'simon';

    if (empty($elements)) {
        return sfView::NONE;
    }

    foreach ($elements as $element) {
        if ($last_status) {
            continue;
        }

        $status = (string) $element;

		$last_status = str_replace($username.': ', '', $status);
		$last_status = str_replace('>'.$username.'<', '>'.ucfirst($username).'<', $last_status);
    }

    $this->last_status = $last_status;
  }
}
