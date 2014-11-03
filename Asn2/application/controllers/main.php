<?php

/**
 * Our homepage. Show a table of all the author pictures. Clicking on one should show their quote.
 * Our quotes model has been autoloaded, because we use it everywhere.
 * 
 * controllers/main.php
 *
 * ------------------------------------------------------------------------
 */
class Main extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['pagebody'] = 'newest';    // this is the view we want shown
        
        // build the list of places, to pass on to our view
        $source = $this->attractions->newest();
        
        //$this->data = array_merge($this->data, $source); //merges quote with this data
        $places = array();
        
        //new attraction into array
            $places[] = array(
                'name' => $source['attr_name'], 
                'pic' => $source->pic, 
                'description' => $source['description'],
                'href' => '/');
            
        
        //send the places array to our data
        $this->data['places'] = $places;

        $this->render();
    }

}

/* End of file main.php */
/* Location: application/controllers/main.php */