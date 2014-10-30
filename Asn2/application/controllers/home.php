<?php

/**
 * Our homepage. Show a table of all the author pictures. Clicking on one should show their quote.
 * Our quotes model has been autoloaded, because we use it everywhere.
 * 
 * controllers/home.php
 *
 * ------------------------------------------------------------------------
 */
class Home extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['pagebody'] = 'homepage';    // this is the view we want shown
        
        // build the list of places, to pass on to our view
        $source = $this->attractions->all();    //get all the attractions from DB
        $places = array();
        
        //place every attraction into places array.
        foreach ($source as $record) {
           //
            $places[] = array('name' => $record['name'], 
                'pic' => $record['pic'], 
                'description' => $record['description'],
                'href' => $record['where'],
                );
        
            
        }
        
        //send places array to our data
        $this->data['places'] = $places;

        $this->render();
    }

}

/* End of file home.php */
/* Location: application/controllers/home.php */