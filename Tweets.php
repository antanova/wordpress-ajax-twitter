<?php

namespace Antanova\Wordpress;


class Tweets
{
    protected $expires = 3600; //60 * 60; // 1 hour before tweets refresh
    
    protected $transient_key = 'Antanova/Wordpress/Tweets';
    
    protected $client;
    
    function __construct(TwitterTokenFactory $factory, TwitterClient $client)
    {
        $this->factory = $factory;
        $this->client  = $client;
    }
    
    /**
     * Get tweets from the user's timeline
     * 
     * @param string   $user   Twitter screen_name
     * @param integer  $count  Number of tweets
     */
    public function getTweets($user, $count)
    {
        $tweets = \get_transient( $this->transient_key );
        
        // if it's not saved, or the saved value was not ok, then fetch it again.
        if ( $tweets === false || $tweets['response']['code'] != 200 ) {
            
            // get a token
            $token = $this->factory->createToken();
            
            if ( $token['response']['code'] != 200 ) {
                
                status_header("{$token['response']['code']}");
                $errors = json_decode($token['body']);
                \wp_send_json(array(
                    'errors' => $errors->errors[0]->message,
                ));
            }
            
            $token_array = json_decode($token['body']);
        
            // set the token for our request
            $this->client->setBearerToken($token_array->access_token);
            
            // fetch the tweets
            $tweets = $this->client->getUserStatuses($user, $count);
            
            // save for later
            \set_transient($this->transient_key, $tweets, $this->expires);
        }
        
        // output the tweets
        \wp_send_json(json_decode($tweets['body']));
    }
    
    
}