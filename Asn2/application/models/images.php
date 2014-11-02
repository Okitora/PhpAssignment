<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data
 *
 * @author Sharon
 */
class Images extends MY_Model {

    // The data comes from http://www.quotery.com/top-100-funny-quotes-of-all-time/?PageSpeed=noscript
    
    
    // Constructor
    public function __construct() {
        parent::__construct('attr_image', 'attr_id');
    }

    
}
