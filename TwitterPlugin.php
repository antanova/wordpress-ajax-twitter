<?php

namespace Antanova\Wordpress;

class TwitterPlugin
{
    protected $factory;
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;

        // set up our endpoint
        add_action('wp_ajax_anta_tweets',         array($this, 'ajax_request'));
        add_action('wp_ajax_nopriv_anta_tweets',  array($this, 'ajax_request'));

        // enqueue scripts when the theme is ready
        add_action('wp_enqueue_scripts',          array($this, 'enqueue_scripts'));
    }

    public function ajax_request()
    {
        $this->factory = new TwitterTokenFactory($this->config['api_key'], $this->config['api_secret']);
        $tweets = new Tweets($this->factory, new TwitterClient());
        $tweets->getTweets($this->config['screen_name'], 3);
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script('twitter', plugins_url('/js/ajax-twitter.js', __FILE__), array('jquery'), null, true);
        //wp_enqueue_script('twittertxt', plugins_url('/node_modules/twitter-text/twitter-text.js', __FILE__), array('jquery'), null, true);
        //wp_enqueue_script('twitter', plugins_url('/js/tweets.js', __FILE__), array('jquery'), null, true);
    }
}
