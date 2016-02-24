<?php 

namespace Antanova\Wordpress;
    
class TwitterTokenFactory
{
    protected $api_key;
    
    protected $secret;
    
    protected $headers = array();
    
    protected $url = 'https://api.twitter.com/oauth2/token';
    
    function __construct($key, $secret)
    {
        $this->api_key = $key;
        $this->secret = $secret;
        
        $this->setAuthorizationHeader();
    }
    
    public function setAuthorizationHeader()
    {
        $token = base64_encode(rawurlencode($this->api_key) . ':' . rawurlencode($this->secret));
        $this->headers['Authorization'] = "Basic $token";
    }
    
    public function createToken()
    {
        $request_body = array(
            'grant_type' => 'client_credentials',
        );
        $request = \wp_safe_remote_post($this->url, array(
            'body' => $request_body,
            'headers' => $this->headers,
        ));
        
        if ( is_wp_error($request) ) {
            //return new \WP_Error('token_error', 'There was a problem requesting a Twitter token: ' . $request->get_error_message());
            die('There was a problem requesting a Twitter token: ' . $request->get_error_message());
        }
        return $request;
    }
    
}