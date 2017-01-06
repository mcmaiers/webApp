<?php

/**
 * @author      Frank Herrmann
 * @copyright   2016
 * @link        https://codeking.de/smarthome/homee.api.zip
 */

use WebSocket\Client;

class Homee extends HomeeTypes
{
    private $url = '';    # Homee URL
    private $user = '';   # Homee Admin User
    private $pass = '';   # Homee Admin Pass

    private $basePath;
    private $cacheDir = 'cache/';

    protected $auth;
    protected $socket;

    protected $debug = false;

    public function __construct($url = NULL, $user = NULL, $pass = NULL, $options = array())
    {
        // set base path
        $this->basePath = dirname(__FILE__);

        // load websocket client
        include_once $this->basePath . '/websocket-php/Exception.php';
        include_once $this->basePath . '/websocket-php/BadOpcodeException.php';
        include_once $this->basePath . '/websocket-php/BadUriException.php';
        include_once $this->basePath . '/websocket-php/ConnectionException.php';
        include_once $this->basePath . '/websocket-php/Base.php';
        include_once $this->basePath . '/websocket-php/Client.php';

        // set url
        $this->url = strpos($url, 'http') === 0 ? $url : 'https://' . $url . '.hom.ee';
        if (substr($this->url, -1) === '/') {
            $this->url = substr($this->url, -1);
        }

        // set auth credentials
        $this->user = $user;
        $this->pass = $pass;

        // set exception handler
        set_exception_handler(array($this, 'error'));

        // overwrite options
        foreach ($options AS $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        // authenticate and get access token
        $this->authenticate();

        // connect to websocket
        $this->connect();
    }

    /**
     * Get all informations
     */
    public function getAll($resort = false, $retry = 0)
    {
        $data = $this->send('GET:all');

        // retry, if wrong data were returned
        if (!isset($nodes['nodes']) && $retry < 5) {
            sleep(1);
            $retry++;
            return $this->getNodes($resort, $retry);
        }

        // resort nodes
        if ($resort && isset($data['nodes'])) {
            $data['nodes'] = $this->_resortNodes($data['nodes']);
        }

        return $data;
    }

    /**
     * Get all nodes / devices
     */
    public function getNodes($resort = false, $retry = 0)
    {
        $nodes = $this->send('GET:nodes');

        // retry, if wrong data were returned
        if (!isset($nodes['nodes']) && $retry < 5) {
            sleep(1);
            $retry++;
            return $this->getNodes($resort, $retry);
        }

        // resort nodes
        if ($resort) {
            $nodes = $this->_resortNodes($nodes);
        }

        return $nodes;
    }

    /**
     * Get node by id
     */
    public function getNodeById($id = NULL)
    {
        if (!$id) {
            throw new Exception('Please provide a valid node id!');
        }

        return $this->send('GET:nodes/' . $id);
    }

    /**
     * Get all nodes / devices
     */
    public function getUsers()
    {
        return $this->send('GET:users');
    }

    /**
     * Get node by id
     */
    public function getUserById($id = NULL)
    {
        if (!$id) {
            throw new Exception('Please provide a valid user id!');
        }

        return $this->send('GET:users/' . $id);
    }

    /**
     * Get all groups
     */
    public function getGroups()
    {
        return $this->send('GET:groups');
    }

    /**
     * Get group by id
     */
    public function getGroupById($id = NULL)
    {
        if (!$id) {
            throw new Exception('Please provide a valid group id!');
        }

        return $this->send('GET:groups/' . $id);
    }

    /**
     * Get all relationships
     */
    public function getRelationships()
    {
        return $this->send('GET:relationships');
    }

    /**
     * Get relationship by id
     */
    public function getRelationshipById($id = NULL)
    {
        if (!$id) {
            throw new Exception('Please provide a valid relationship id!');
        }

        return $this->send('GET:relationships/' . $id);
    }

    /**
     * Get all homeegrams
     */
    public function getHomeeGrams()
    {
        return $this->send('GET:homeegrams');
    }

    /**
     * Get homeegram by id
     */
    public function getHomeeGramById($id = NULL)
    {
        if (!$id) {
            throw new Exception('Please provide a valid homeegram id!');
        }

        return $this->send('GET:homeegrams/' . $id);
    }

    /**
     * Get settings
     */
    public function getSettings()
    {
        return $this->send('GET:settings');
    }

    /**
     * Update node attribute
     */
    public function updateNodeAttribute($node_id = NULL, $attribute_id = NULL, $update = array())
    {
        if (!$node_id) {
            throw new Exception('Please provide a valid node id!');
        } else if (!$attribute_id) {
            throw new Exception('Please provide a valid attribute id for node id' . $node_id . '!');
        } else if (empty($update)) {
            throw new Exception('Please provide the update options for ' . $update . '!');
        }

        // build update params
        $params = http_build_query($update);

        // send request
        return $this->send('PUT:nodes/' . $node_id . '/attributes/' . $attribute_id . '?' . $params);
    }

    /**
     * Authenticates to homee and retrieve the access token
     */
    private function authenticate()
    {
        $cacheFile = $this->cacheDir . '/homee.token.json';

        // check for cached token
        if (file_exists($cacheFile)) {
            $auth = file_get_contents($cacheFile);
            $auth = @json_decode($auth, true);

            // verify token
            if (isset($auth['expires']) && filemtime($cacheFile) + $auth['expires'] > time()) {
                $this->auth = $auth;
                return;
            }
        }

        // urlencode user
        $user = urlencode($this->user);

        // hash password
        $pass = hash('sha512', $this->pass); // SHA-512
        $pass = strtolower($pass); // lowercase hash

        // retrieve access token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . '/access_token');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $user . ':' . $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            'device_hardware_id' => md5($this->url),
            'device_name' => 'Homee PHP Wrapper',
            'device_type' => 4,
            'device_os' => 3,
            'device_app' => 1
        )));

        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status_code == 200) {
            parse_str($response, $this->auth);

            // cache token
            file_put_contents($cacheFile, json_encode($this->auth));
        } else {
            throw new Exception('Authentication: invalid access data');
        }
    }

    /**
     * Establishing connection to websocket
     */
    public function connect()
    {
        // get socket data
        $url = parse_url($this->url);

        // use ssl wss://
        if (!isset($url['port'])) {
            $socket_url = str_replace($url['scheme'], 'wss', $this->url) . ':443';
        } // use ws://
        else {
            $socket_url = str_replace($url['scheme'], 'ws', $this->url);
        }

        // build params
        $params = array(
            'access_token' => $this->auth['access_token']
        );
        $params = http_build_query($params);

        // create socket connection
        $this->socket = new Client($socket_url . '/connection?' . $params, array(
            'headers' => array(
                'sec-websocket-protocol' => 'v2'
            )
        ));
    }

    /**
     * Sends message to socket
     */
    private function send($data)
    {
        // send data to socket
        $this->socket->send($data);

        // read response
        $response = $this->socket->receive();

        // convert json response to array
        $response = json_decode($response, true);

        // map types
        $response = $this->_mapTypes($response);

        // return response
        return $response;
    }

    /**
     * response an array to json
     */
    public function toJson($data = NULL)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Dump data
     */
    public function dump($data = array())
    {
        echo '<pre>';
        print_r($data);
        exit;
    }

    /**
     * Loop array and map readable types
     */
    private function _mapTypes($data = NULL, $parent_key = false)
    {
        if (is_array($data)) {
            foreach ($data AS $key => $item) {
                $needle = is_numeric($key) || !is_array($item) ? $parent_key : $key;

                if (is_array($item)) {
                    $k = is_numeric($key) ? $parent_key : $key;
                    $data[$key] = $this->_mapTypes($item, $k);
                } else {
                    if ($key == 'name') {
                        $data[$key] = urldecode($data[$key]);
                    }

                    $item_needles = array(
                        1 => $needle . '_' . $key,
                        2 => $needle . 's_' . $key
                    );

                    foreach (array(1, 2) AS $i) {
                        $item_needle = $item_needles[$i];
                        if (property_exists($this, $item_needle)) {
                            $property = $this->$item_needle;
                            $value = isset($property[$item]) ? $property[$item] : $item . '?';
                            $data = array('_' . $key => $value) + $data;
                        }
                    }
                }
            }
        }

        return $data;
    }

    /**
     * Internal functions
     */

    protected function _toUnderscore($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];

        if ($ret) {
            foreach ($ret AS &$match) {
                $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
            }
            return implode('_', $ret);
        } else {
            return $input;
        }
    }

    /**
     * Resorts node attributes, for better readability by other apis
     */
    protected function _resortNodes($data = array())
    {
        if (isset($data['nodes']) && is_array($data['nodes'])) {
            foreach ($data['nodes'] AS &$node) {
                $attributes = array();
                foreach ($node['attributes'] AS $attribute) {
                    // try to detect most useful value
                    if (isset($attribute['data']) && strlen($attribute['data']) > 0) {
                        $value = $attribute['data'];
                    } else if (isset($attribute['target_value'])) {
                        $value = $attribute['target_value'];
                    }

                    $attribute = array('_value' => $value) + $attribute;

                    // set profile as key index
                    $key = $this->_toUnderscore($attribute['_type']);
                    $attributes[$key] = $attribute;
                }

                $node['attributes'] = $attributes;

                // map main value
                $mapped_value = $this->nodes_profile_value_mapping[$node['_profile']];

                // map type
                $mapped_type = $this->nodes_profile_type_mapping[$node['_profile']];

                $_value = array(
                    '_value' => isset($mapped_value) && $mapped_value ? $attributes[$mapped_value]['_value'] : 0,
                    '_type' => isset($mapped_type) && $mapped_type ? $mapped_type : false,
                    '_value_attribute' => isset($mapped_value) && $mapped_value ? $mapped_value : false
                );
                $node = $_value + $node;
            }
        }

        return $data;
    }

    /**
     * Exception handler
     */
    public function error($exception)
    {
        die(nl2br($exception));
    }
}