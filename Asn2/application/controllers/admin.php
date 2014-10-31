<?php

/**
 * Our homepage. Show a table of all the author pictures. Clicking on one should show their quote.
 * Our quotes model has been autoloaded, because we use it everywhere.
 * 
 * controllers/admin.php
 *
 * ------------------------------------------------------------------------
 */
class Admin extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['pagebody'] = 'admin';    // this is the view we want shown
       
        // build the list of places, to pass on to our view
        $source = $this->attractions->all();    //get all the attractions from DB
        $places = array();
        
        //place every attraction into places array.
        foreach ($source as $record) {
           //
            $places[] = array(
                'code'        => $record['code'],
                'name'        => $record['name'], 
                'pic'         => $record['pic'], 
                'description' => $record['description'],
                'category'    => $record['category'],
                'href'        => $record['where'],
            );
        
            
        }
        
        //send places array to our data
        $this->data['places'] = $places;

        $this->render();
    }
    
    function editlist()
    {
        $this->data['pagebody'] = 'editlist';   
        
        //get all attractions
        $source = $this->attractions->all();
        $items = '';
        
        foreach ($source as $record) 
        {
            $items .= $this->parser->parse('edit2', $record, true);
            
        }      
        
        //display nested view
        $this->data['themeat'] = $items;
        
        $this->render();
    }
    
    
    function edit3($which) {
        
        $this->data['pagebody'] = 'edit3';  //this is the view that we want

        // use “item” as the session key
        // assume no item record in-progress
        $item_record = null;
        // do we have an item in the session already {
        $session_record = $this->session->userdata('item');
        if ($session_record !== FALSE) {
            // does its item # match the requested one {
            if (isset($session_record['name']) && ($session_record['name'] == $which)) {
                // use the item record from the session
                $item_record = $session_record;
            }   
        }

        // if no item-in progress record {
        if ($item_record == null) {
            
            // get the item record from the items model
            $item_record = (array) $this->attractions->need($which);
            
            // save it as the “item” session object
            $this->session->set_userdata('item', $item_record);
        }

        // merge the view parms with the current item record
        //$this->data = array_merge($this->data, $item_record);
        
        // we need to construct pretty editing fields using the formfields helper
        $this->load->helper('formfields');
        $this->data['fcode'] = makeTextField('Item Code', 'code', $item_record['code'], "item identifier ... cannot be changed", 10, 25, true);
        $this->data['fname'] = makeTextField('Name', 'name', $item_record['name'], "Name your customers are comfortable with");
        $this->data['fdescription'] = makeTextArea('Description', 'description', $item_record['description'], 'This is a long-winded and humorous caption that pops up if the visitor hovers over a menu item picture too long.');
        
        $options = array('m' => 'Meal', 'd' => 'Drink', 's' => 'Sweet');
        $this->data['fcategory'] = makeComboField('Menu category', 'category', $item_record['category'], $options, "Menu category. Used to group similar things by column for ordering");
        $this->data['fpicture'] = showImage('Menu picture shown at ordering time', $item_record['pic']);
        $this->data['fsubmit'] = makeSubmitButton('Post Changes', 'Do you feel lucky?');
        
        $this->render();
    }
    
    // handle a proposed menu item form submission
    function post3($which) {
        $fields = $this->input->post(); // gives us an associative array
        
        // test the incoming fields
        if (strlen($fields['name']) < 1)
        {
            $this->errors[] = 'An item has to have a name!';
        }
        if (strlen($fields['description']) < 1) 
        {
            $this->errors[] = 'An item has to have a description!';
        }

        $cat = $fields['category'];
        if (($cat != 'm') && ($cat != 'd') && ($cat != 'w')) 
        {
            $this->errors[] = 'Your category has to be one of m, d or c :(';
        }

        // get the session item record
        $record = $this->session->userdata('item');
        
        // merge the session record into the model item record, over-riding any edited fields
        $record = array_merge($record, $fields);
        
        // update the session
        $this->session->set_userdata('item', $record);
        
        // update if ok
        if (count($this->errors) < 1) 
        {
            // store the merged record into the model
            $this->attractions->update($record);
            // remove the item record from the session container
            $this->session->unset_userdata('item');
            redirect('/admin/editlist');
        } 
        else 
        {
            $this->edit3($which);
        }
    }



}

/* End of file admin.php */
/* Location: application/controllers/admin.php */