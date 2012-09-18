This project is an example of how simple the Zend HTTP Client could be. It consists of 2 parts:

 - A simple HTTP Client class
 - A simple API base class that you can extend

## Usage:

Let's say you have a RESTful API that returns a json response. You can interact with it directly using the simple HTTP client class:

    $client = new SimpleHttpClient($base_url);
    $results = $client->request($method, $path, $params);

Our you can abstract this one more level by extending the simple API base class:

    class OurApi extends SimpleApiBase {}

Now we can interact with our API in our application:

    $widgets = OurApi::get('/widgets', array('order_by' => 'name'));

    $widget = OurApi::post('/widgets', array('name' => 'my new widget'));

    OurApi::put("/widgets/{$widget['ID']}", array('name' => 'my updated widget'));
    
    OurApi::delete("/widgets/{$widget['ID']}");

## TODO:

 - Remove dependency on Zend_Http_Client