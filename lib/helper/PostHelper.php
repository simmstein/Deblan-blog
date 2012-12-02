<?php
/* octobre 2007 */

function parse_commentaire($str) {
	$str = html($str);
	$str = str_replace('&lt;3', '<span style="color:#FF3333; font-weight:bold;">&lt;3</span>', $str);
	$str = preg_replace('`https?://[^\s\)]+`is', '<a href="$0">$0</a>', $str);
	$str = nl2br($str);

	/*preg_match_all('`>(http://wall.deblan.fr/x[^<]*)<`iU', $str, $walls, PREG_SET_ORDER);

	if(!empty($walls)) {
		foreach($walls as $wall) {
			$id  = mt_rand();
			$str.= '<br /><br />';
			$str.= htmlentities($wall[1]);
			$str.= '<div id="u'.$id.'"></div>';
			$str.= '<script src="http://wall.deblan.fr/js.php?uid='.$id.'&url='.htmlentities($wall[1]).'"></script>';
		}
	}*/

	return $str;
	//$str = iconv('ISO-8859-1', "UTF-8", $str);
}

function parse_p($data) {
	//return str_replace("\n", "<br />", $data[0]);

  /*$data[2] = htmlentities($data[2]);
  
  $html = array('`&lt;a(.*)&gt;(.*)&lt;/a&gt;`isU', '`&lt;img(.*)&gt;`isU', 
          '`&lt;strong(.*)&gt;(.*)&lt;/strong&gt;`isU', '`&lt;em(.*)&gt;(.*)&lt;/em&gt;`isU', '`&lt;url&gt;(.*)&lt;/url&gt;`isU', '`&lt;li(.*)&gt;(.*)&lt;/li&gt;`isU',
          '`&lt;ul(.*)&gt;(.*)&lt;/ul&gt;`isU',  
          '`&lt;div(.*)&gt;(.*)&lt;/div&gt;`isU', '`&lt;span(.*)&gt;(.*)&lt;/span&gt;`isU', '`&lt;html(.*)&gt;(.*)&lt;/html&gt;`isU',  
          '`&lt;acronym(.*)&gt;(.*)&lt;/acronym&gt;`isU', '`&lt;nonl2br(.*)&gt;(.*)&lt;/nonl2br&gt;`isU', '`&lt;mp3&gt;(.*)&lt;/mp3&gt;`isU');
  
  foreach($html as $balise) {
    $data[2] = preg_replace_callback($balise,
      create_function(
        '$matches',
        'return html_entity_decode($matches[0]);'
      ),
       $data[2]
    );
  }*/
  
  if(preg_match('`^[ ]+`', @$data[1])) {
   return '<p'.$data[1].'>'.nl2br(trim($data[2])).'</p>';
  }
  elseif(@$data[1]=='') {
   return '<p>'.nl2br(trim(@$data[2])).'</p>';
  }
  else {
   return @$data[0];
  }
}

function parse_centre($data) {
  /*$data[1] = htmlentities($data[1]);
  
  $html = array('`&lt;a(.*)&gt;(.*)&lt;/a&gt;`isU', '`&lt;img(.*)&gt;`isU', 
          '`&lt;strong(.*)&gt;(.*)&lt;/strong&gt;`isU', '`&lt;em(.*)&gt;(.*)&lt;/em&gt;`isU', '`&lt;url&gt;(.*)&lt;/url&gt;`isU', '`&lt;li(.*)&gt;(.*)&lt;/li&gt;`isU',
          '`&lt;ul(.*)&gt;(.*)&lt;/ul&gt;`isU',  
          '`&lt;div(.*)&gt;(.*)&lt;/div&gt;`isU', '`&lt;span(.*)&gt;(.*)&lt;/span&gt;`isU', '`&lt;html(.*)&gt;(.*)&lt;/html&gt;`isU',  
          '`&lt;acronym(.*)&gt;(.*)&lt;/acronym&gt;`isU', '`&lt;nonl2br(.*)&gt;(.*)&lt;/nonl2br&gt;`isU', '`&lt;mp3&gt;(.*)&lt;/mp3&gt;`isU');
  
  foreach($html as $balise) {
    $data[1] = preg_replace_callback($balise,
      create_function(
        '$matches',
        'return html_entity_decode($matches[0]);'
      ),
       $data[1]
    );
  } */

  return '<p class="centre">'.nl2br(trim($data[1])).'</p>';
}

function parse_droite($data) {
  /*$data[1] = htmlentities($data[1]);
  
  $html = array('`&lt;a(.*)&gt;(.*)&lt;/a&gt;`isU', '`&lt;img(.*)&gt;`isU', 
          '`&lt;strong(.*)&gt;(.*)&lt;/strong&gt;`isU', '`&lt;em(.*)&gt;(.*)&lt;/em&gt;`isU', '`&lt;url&gt;(.*)&lt;/url&gt;`isU', '`&lt;li(.*)&gt;(.*)&lt;/li&gt;`isU',
          '`&lt;ul(.*)&gt;(.*)&lt;/ul&gt;`isU',  
          '`&lt;div(.*)&gt;(.*)&lt;/div&gt;`isU', '`&lt;span(.*)&gt;(.*)&lt;/span&gt;`isU', '`&lt;html(.*)&gt;(.*)&lt;/html&gt;`isU',  
          '`&lt;acronym(.*)&gt;(.*)&lt;/acronym&gt;`isU', '`&lt;nonl2br(.*)&gt;(.*)&lt;/nonl2br&gt;`isU', '`&lt;mp3&gt;(.*)&lt;/mp3&gt;`isU');
  
  foreach($html as $balise) {
    $data[1] = preg_replace_callback($balise,
      create_function(
        '$matches',
        'return html_entity_decode($matches[0]);'
      ),
       $data[1]
    );
  }*/
    
  return '<p class="droite">'.nl2br(trim($data[1])).'</p>';
}

function parse_flgauche($data) {
  return '<div class="flgauche">'.$data[1].'</div>';
}

function parse_fldroite($data) {
  return '<div class="fldroite">'.$data[1].'</div>';
}


function parse_h4($data) {
  /*$data[1] = htmlentities($data[1]);

  $html = array('`&lt;a(.*)&gt;(.*)&lt;/a&gt;`isU', '`&lt;img(.*)&gt;`isU', 
          '`&lt;strong(.*)&gt;(.*)&lt;/strong&gt;`isU', '`&lt;em(.*)&gt;(.*)&lt;/em&gt;`isU', '`&lt;url&gt;(.*)&lt;/url&gt;`isU', '`&lt;li(.*)&gt;(.*)&lt;/li&gt;`isU',
          '`&lt;ul(.*)&gt;(.*)&lt;/ul&gt;`isU',  
          '`&lt;div(.*)&gt;(.*)&lt;/div&gt;`isU', '`&lt;span(.*)&gt;(.*)&lt;/span&gt;`isU', '`&lt;html(.*)&gt;(.*)&lt;/html&gt;`isU',  
          '`&lt;acronym(.*)&gt;(.*)&lt;/acronym&gt;`isU', '`&lt;nonl2br(.*)&gt;(.*)&lt;/nonl2br&gt;`isU', '`&lt;mp3&gt;(.*)&lt;/mp3&gt;`isU');
  
  foreach($html as $balise) {
    $data[1] = preg_replace_callback($balise,
      create_function(
        '$matches',
        'return html_entity_decode($matches[0]);'
      ),
       $data[1]
    );
  }
      */
  
  return '<h4>'.$data[1].'</h4>';
}

function parse_h5($data) {
  /*$data[1] = htmlentities($data[1]);

  $html = array('`&lt;a(.*)&gt;(.*)&lt;/a&gt;`isU', '`&lt;img(.*)&gt;`isU', 
          '`&lt;strong(.*)&gt;(.*)&lt;/strong&gt;`isU', '`&lt;em(.*)&gt;(.*)&lt;/em&gt;`isU', '`&lt;url&gt;(.*)&lt;/url&gt;`isU', '`&lt;li(.*)&gt;(.*)&lt;/li&gt;`isU',
          '`&lt;ul(.*)&gt;(.*)&lt;/ul&gt;`isU',  
          '`&lt;div(.*)&gt;(.*)&lt;/div&gt;`isU', '`&lt;span(.*)&gt;(.*)&lt;/span&gt;`isU', '`&lt;html(.*)&gt;(.*)&lt;/html&gt;`isU',  
          '`&lt;acronym(.*)&gt;(.*)&lt;/acronym&gt;`isU', '`&lt;nonl2br(.*)&gt;(.*)&lt;/nonl2br&gt;`isU', '`&lt;mp3&gt;(.*)&lt;/mp3&gt;`isU');
  
  foreach($html as $balise) {
    $data[1] = preg_replace_callback($balise,
      create_function(
        '$matches',
        'return html_entity_decode($matches[0]);'
      ),
       $data[1]
    );
  }*/
      
  
  return '<h5>'.$data[1].'</h5>';
}

function parse_li($data) {
	//$data[1] = htmlentities($data[1]);
  return '<li>'.trim(($data[1])).'</li>';
}

function parse_nonl2br($data) {
   return str_replace('<br />', '', $data[1]);
}

function parse_encode($data) {
  return htmlentities($data[1]);
}

function parse_html_($data) {
  return html_entity_decode($data[1]);
}

function parse_style($data) {
  $l = explode("\n", $data[1]);
  $r = '<script type="text/javascript"><!--';
  $r.= "\ndocument.write('<style type=\'text/css\'>');";
  foreach($l as $vl) {
   if(trim($vl) != '') {
    $r.= "\ndocument.write('".str_replace("'", "\'", trim($vl))."');";
   }
  }
  $r.= "\ndocument.write('</style>');";
  $r.= "\n--></script>";
  return $r;
  
}

function parse_videoflv($data) {
  return '<object type="application/x-shockwave-flash" data="/system/flash/player_flv.swf"'
    .' width="414" height="314"><param name="movie" value="/system/flash/player_flv.swf" />'
    .'<param name="FlashVars" '
    .'value="flv='.$data[1].'&amp;'
    .'width=414&amp;height=314&amp;showstop=1&amp;showvolume=1&amp;showtime=1&amp;'
    .'skin=&amp;margin=0&amp;startimage=&amp;playercolor=ffffff&amp;buttoncolor=333333&amp;'
    .'buttonovercolor=999999&amp;margin=5&amp;slidercolor1=999999&amp;slidercolor2=CCCCCC&amp;sliderovercolor=BBBBBB&amp;loadingcolor=333333&amp;playercolor=ffffff" /></object>';
}

function parse_mp3($data) {
return '<object class="playerpreview" type="application/x-shockwave-flash"
data="/system/flash/mp3.swf" width="200" height="20">
<param name="movie" value="/system/flash/mp3.swf" />
<param name="FlashVars" value="mp3='.$data[1].'&amp;showstop=1&amp;showvolume=1&amp;showinfo=1&amp;loadingcolor=cccccc" />
</object>';
}

function parse_quote($data) {
  $data[1] = preg_replace('`<p>(.*)</p>`isU', '<p>&#171; $1 &#187;</p>', parse_p(array(0, '', $data[1]) ) ) ;
  return '<div class="quote"><div class="texte">'.html_entity_decode($data[1]).'</div></div>';
}

function parse_quote2($data) {
  $texte[2] = $data[2];
  $data[2] = str_replace(array('<p>', '</p>'), array('<p>&#171; ', ' &#187;</p>'), parse_p($texte));
  return '<div class="quote"><div class="texte">'.$data[2].'<span class="auteur">'.nl2br(trim($data[1])).'</span></div></div>';
}

require(dirname(__FILE__).'/../color/geshi.php');

function parse_code($data) {
  static $lignescript = 1;
  
  $langage = $data[1];
  $script  = trim($data[2]);

	$g = new GeShi($script, str_replace(array('html', 'console'), array('html4scrict', 'bash'), $langage));
	//$g->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 5);
	return '<div class="code">'.$g->parse_code().'</div>';

  if(file_exists(dirname(__FILE__).'/../color/color.'.$langage.'.php')) {
    require_once(dirname(__FILE__).'/../color/color.'.$langage.'.php');
    if($langage == 'php') $script = parse_php($script);
    if($langage == 'html') $script = parse_html($script);
    if($langage == 'css') $script = parse_css($script);
    if($langage == 'javascript') $script = parse_javascript($script);
    if($langage == 'console') $script = parse_console($script);
    if($langage == 'asp') $script = parse_asp($script);
  }
  
  $script = str_replace('<font color="', '<span style="color:', $script);
  $script = str_replace('</font>', '</span>', $script);
  $script = preg_replace("`\s*</span>\s*</code>`isU", '</span></code>', $script);
  $script = preg_replace("`<span style=\"color:#([a-fA-F0-9]+)\">\s+`isU", '<span style="color:#$1">', $script);
  
  if($langage == 'as') {
    $langage = 'action script';
  } 
  if($langage == 'css') {
    $langage = 'CSS';
  }
  
  /*$premier_ligne = $lignescript++;
  
  $script = str_replace('<code>', '<code><span class="ligne" id="lg'.$premier_ligne.'">1.</span>', $script);
  
  if(ereg('<br />', $script)) {
    $lignes = explode('<br />', $script);
    for($u=2; $u<=count($lignes); $u++) {
      if($u%5==0) {
        $lignes[$u-1] = '<span class="ligne2" id="lg'.$lignescript++.'">'.$u.'.</span>'.$lignes[$u-1];
      } else {
        $lignes[$u-1] = '<span class="ligne" id="lg'.$lignescript++.'">'.$u.'.</span>'.$lignes[$u-1];
      }
    }
  } else {
    $lignes = explode("\n",  $script);
    for($u=2; $u<=count($lignes); $u++) {
      if($u%5==0) {
        $lignes[$u-1] = '<span class="ligne2" id="lg'.$lignescript++.'">'.$u.'.</span>'.$lignes[$u-1];
      } else {
        $lignes[$u-1] = '<span class="ligne" id="lg'.$lignescript++.'">'.$u.'.</span>'.$lignes[$u-1];
      }    
    }
  }
  
  $script = implode('<br />', $lignes);*/
  
  $script = str_replace("\n", '', $script);
  $script = str_replace("\r", '', $script);
  $script = str_replace('<br&nbsp;/', '<br /', $script);
  
  $uid = mt_rand();
  
  return '<div class="code">
    <div class="code_options">
      <a class="mode_texte" id="mtexte'.$uid.'">Afficher en mode texte</a>
    </div>
    <span class="auteur">Langage : '.$langage.'</span>
    <pre id="pcode'.$uid.'">'.$script.'</pre>
    <textarea cols="30" rows="5" id="tcode'.$uid.'" class="tcode hidden">'.trim(htmlentities($data[2])).'</textarea>
    <script type="text/javascript">codeOpt('.$uid.');</script>
</div>';
}

function parse_clear($data) {
  return '<div class="clear"></div>';
}

function youtube_dailymotion($data) {
  return str_replace('&', '&amp;', $data[0]);
}

function url($data) {
  return '<a href="'.$data[1].'">'.$data[1].'</a>';
}

function parse_object($data) {
  return '<script type="text/javascript"><!--'."\n".
  "document.write('<object".preg_replace("`\s+`is", ' ', $data[1])."/object>')\n".'--></script>';
}

function parse_smiley($data) {
  /*if( file_exists(ROOT.'/templates/images/smileys/'.$data[1].'.gif') ) {
    return '<img class="smiley" src="/templates/images/smileys/'.$data[1].'.gif" alt="'.$data[0].'" title="'.$data[1].'" />';
  } else {
    return $data[0];
  }*/
}

function parse_galerie($data) {
    static $u = 0;
    $imgs = explode("\n", trim($data[1]));
    $rand = 'group'.$u++;
    $html = '<div class="galerie">';
    
    foreach($imgs as $i) {
        $_imgs = explode('|', $i);
        if(count($_imgs) > 1) {
            $html.= '<a href="'.htmlentities(trim($_imgs[0])).'"';
            if(isset($_imgs[2])) {
                $html.=' title="'.htmlentities(trim($_imgs[2])).'" ';
            }
            
            $html.= ' rel="milkbox['.$rand.']">';
            $html.= '<img src="'.htmlentities(trim($_imgs[1])).'"';

            if(isset($_imgs[2])) {
                $html.=' alt="'.htmlentities(trim($_imgs[2])).'" title="'.htmlentities(trim($_imgs[2])).'" ';
            } else {
              $html.=' alt="" title="" ';
            }            
            $html.= '/></a>';    
        }
    }
    
    $html.= '</div>';
    
    return $html;
}

function parse_sondage($data) {
    $html = '';
  if(is_dir(ROOT.'/sondages/'.$data[1])) {
    $sondage = file(ROOT.'/sondages/'.$data[1].'/sondage.html');
    $totvo = 0;
    
    $html.='<div class="sondage">'."\n".'<h4>'.trim($sondage[0]).'</h4>'."\n";
    unset( $sondage[0] );
    $html.=' <ul>'."\n";
    
    foreach( $sondage as $key=>$question ) {
     $question = explode(' ', trim($question) );
     $nbvotes  = array_pop($question);
     $totvo+= $nbvotes;
     
     $url = getVoterSondageLink(
           implode(' ', $question), 
           $data[1], 
           $key
         ).'?url='.$_SERVER['REQUEST_URI'];
     
     unset( $question[ count($question) ] );
     if($nbvotes > 1) 
     $html.='  <li><a rel="nofollow" href="'.$url.'">'.htmlentities(implode(' ', $question)).'</a> <strong>'.$nbvotes.' votes</strong></li>'."\n";
     else
     $html.='  <li><a rel="nofollow" href="'.$url.'">'.htmlentities(implode(' ', $question)).'</a> <strong>'.$nbvotes.' vote</strong></li>'."\n";
    }
    
    $html.=' </ul>';
    
    if($totvo == 0) {
      $html.= '<p>Aucune personne n\'a vot&eacute;.</p>';
    }
    elseif($totvo == 1) {
      $html.= '<p>Une seule personne a vot&eacute;.</p>';
    } else {
      $html.= '<p>'.$totvo.' personnes ont vot&eacute;.</p>';
    }
    
    $html.= "\n".'</div>';
  }
  return $html;
}

function parse_texte($texte) {
	$texte = preg_replace_callback('`<p([^>]*)>(.*)</p([^>]*)>`isU', 'parse_p', $texte);
  $texte = preg_replace_callback('`<centre>(.*)</centre>`isU', 'parse_centre', $texte);
  $texte = preg_replace_callback('`<clear>(.*)</clear>`isU', 'parse_clear', $texte);
  $texte = preg_replace_callback('`<droite>(.*)</droite>`isU', 'parse_droite', $texte);
  $texte = preg_replace_callback('`<flgauche>(.*)</flgauche>`isU', 'parse_flgauche', $texte);
  $texte = preg_replace_callback('`<fldroite>(.*)</fldroite>`isU', 'parse_fldroite', $texte);
  $texte = preg_replace_callback('`<h4></h4>`isU', 'parse_h4', $texte);
  $texte = preg_replace_callback('`<h5></h5>`isU', 'parse_h5', $texte);
  $texte = preg_replace_callback('`<titre>(.*)</titre>`isU', 'parse_h4', $texte);
  $texte = preg_replace_callback('`<sstitre>(.*)</sstitre>`isU', 'parse_h5', $texte);
  $texte = preg_replace_callback('`<videoflv>(.*)</videoflv>`isU', 'parse_videoflv', $texte);
  $texte = preg_replace_callback('`<mp3>(.*)</mp3>`isU', 'parse_mp3', $texte);
  $texte = preg_replace_callback('`<li>(.*)</li>`isU', 'parse_li', $texte);
  $texte = preg_replace_callback('`<style>(.*)</style>`isU', 'parse_style', $texte);
  $texte = preg_replace_callback('`<quote auteur="([^"]+)">(.*)</quote>`isU', 'parse_quote2', $texte);
  $texte = preg_replace_callback('`<quote auteur=\'([^\']+)\'>(.*)</quote>`isU', 'parse_quote2', $texte);
  $texte = preg_replace_callback('`<quote>(.*)</quote>`isU', 'parse_quote', $texte);
  $texte = preg_replace_callback('`<html>(.*)</html>`isU', 'parse_html_', $texte);
  $texte = preg_replace_callback('`<encode>(.*)</encode>`isU', 'parse_encode', $texte);
  $texte = preg_replace_callback('`<sondage>([0-9]+)</sondage>`isU', 'parse_sondage', $texte);
  $texte = preg_replace_callback('`<nonl2br>(.*)</nonl2br>`isU', 'parse_nonl2br', $texte);
  $texte = preg_replace_callback('`<object(.*)/object>`isU', 'parse_object', $texte);
  $texte = preg_replace_callback('`smiley:([a-zA-Z]*)`is', 'parse_smiley', $texte);
  $texte = preg_replace_callback('`<code langage="([^"]*)">(.*)</code>`isU', 'parse_code', $texte);
  $texte = preg_replace_callback('`<code langage=\'([^\']*)\'>(.*)</code>`isU', 'parse_code', $texte);
  $texte = preg_replace_callback('`<url>([^<]+)</url>`isU', 'url', $texte);
  $texte = preg_replace_callback('`<galerie>(.*)</galerie>`isU', 'parse_galerie', $texte);
  $texte = preg_replace_callback('`"http://www.youtube.com/[^"]+"`i', 'youtube_dailymotion', $texte);
  $texte = preg_replace_callback('`"http://www.dailymotion.com/[^"]+"`i', 'youtube_dailymotion', $texte);
  $texte = str_replace('<timestamp>', time(), $texte);
  $texte = str_replace('&lt;timestamp&gt;', time(), $texte);
  $texte = str_replace('<couper>', '', $texte);
 	$texte = str_replace("onclick='window.open(this.href); return false'", '', $texte);

  $encode = iconv_get_encoding($texte);

	//if($encode['input_encoding'] == "ISO-8859-1") {
		$texte = iconv('ISO-8859-1', "UTF-8", $texte);
	//}

	//$texte = utf8_decode($texte);

 	return $texte;
}
