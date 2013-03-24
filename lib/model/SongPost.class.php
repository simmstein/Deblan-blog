<?php

class SongPost
{
    private $html_content = null;
    private $post = null;

    public function __construct(Post $post)
    {
        $this->html_content = $this->cleanUpContent($post->getContent());
        $this->post = $post;
    }

    protected function cleanUpContent($content)
    {
        return preg_replace(
            array(
                '`<img[^>]+>`',
                '`<code[^>]*>.*</code>`isU',
                '`<[^>]+>`'
            ),
            '',
            $content
        );
    }

    public function save()
    {
        $ogg_file = sfConfig::get('sf_root_dir').'/web/songs_posts/'.$this->post->getId().'.ogg';

        if (file_exists($ogg_file) && filemtime($ogg_file) >= strtotime($this->post->getUpdatedAt())) {
            //return true;
        }

        if (file_exists($ogg_file)) {
            unlink($ogg_file);
        }

        $tmp = '/tmp/post-'.$this->post->getId();

        $words = explode(' ', $this->html_content);

        foreach ($words as $k => $v) {
            $words[$k] = utf8_decode($v);
        }

        file_put_contents($tmp, implode(' ', $words));

        return shell_exec('cat '.$tmp.' | espeak -v mb-fr1 --stdout | ffmpeg -i - '.$ogg_file);
    }
}
