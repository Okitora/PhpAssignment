<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data
 *
 * @author jim
 */
class Attractions extends CI_Model {

    // The data comes from http://www.quotery.com/top-100-funny-quotes-of-all-time/?PageSpeed=noscript
    
    var $data = array(
        array('name' => 'Larnach Castle', 'date' => 1406409046, 'contact' => 'scooby doo',
            'location' => 'Otago Peninsula', 'category' => 'building', 'pic' => 'Larnach-Castle-02_opt.jpg',
            'where' => '/',
            'description' => 'With its exciting, sometimes scandalous and tragic history, magnificent carved ceilings, New Zealand antiques and breathtaking views, Larnach Castle offers you a vision of the past and present. Today, the Castle is the home of the Barker family, who have spent over forty years lovingly restoring the building and recreating the beauty of the 14 hectares of gardens and grounds. from: http://www.larnachcastle.co.nz/'),
        
        array('name' => 'Rotoura', 'date' => 1393621846, 'contact' => 'travel2000.com', 
            'location' => 'Rotoura', 'category' => 'nature', 'pic' => 'Lake-Rotorua-New-Zealand.jpg',
            'where' => '/springs',
            'description' => 'Rotorua is known as the thermal wonderland of New Zealand. There are numerous geysers and hot springs in and around the city. Many of these are in parks and reserves. Natural eruptions of steam, hot water and mud occasionally occur in new locations. Nearby Wai-O-Tapu is also a popular tourist attraction with many hot springs noted for their colorful appearance, in addition to the Lady Knox Geyser. from http://www.touropia.com/tourist-attractions-in-new-zealand/'),
        array('name' => 'Waitomo \'Glowworm\' Caves', 'date' => 1373749846, 'contact' => 'dial 866 wow deal', 
            'location' => 'Waitomo', 'category' => 'nature', 'pic' => 'waitomo-glowworm-caves-1.jpg',
            'where' => '/Caves', 'pic2' => 'flere-glowworms-waitomo-caves.jpg',
            'pic3' => 'glow-worm-caves-waitomo-2.jpg',
            'description' => 'More than 30 million years ago, the legend of Waitomo Caves began with the creation of limestone at the bottom of the ocean. Now these limestone formations stand as one of New Zealand\'s most inspiring natural wonders and a must-see destination. The Waitomo region is home to unforgettable sightseeing attractions. Discover magical glowworms by boat in the world famous Waitomo Glowworm Caves. Combine your experience with Ruakuri Cave; see glowworms up close and descend a spectacular spiral entrance. In Aranui Cave be mesmerised by ornate cave decorations. For NZ rafting adventure, get your blood pumping with The Legendary Black Water Rafting Co. from: http://www.waitomo.com/'),
        array('name' => 'Franz Josef Glacier', 'date' => 1336338646, 'contact' => 'rings',
            'location' => 'Franz Josef Glacier', 'category' => 'nature', 'pic' => '124844-004-2FC88AA3.jpg', 
            'where' => '/List',
            'description' => 'This glacier, located within Westland National Park in the southwest, is one of the world’s most accessible. Visitors can walk right up to the foot of the massive glacier or take a helicopter ride over the dazzling Ice Age remnant. Together with Fox Glacier it is one of South Westland’s major drawcards for tourists. from: http://www.touropia.com/tourist-attractions-in-new-zealand/'),
        array('name' => 'Milford Sound', 'date' => 1393665846, 'contact' => 'oceania',
            'location' => 'Milford Sound', 'category' => 'nature', 'pic' => 'The-gushing-waterfall-in-the-Milford-Sound-New-Zealand.jpg',
            'where' => '/List',
            'description' => 'Despite being one of the most accessible fiords, Milford Sound remains quiet and still, bounded by steep cliffs and dense rainforest. Rain or shine, Milford Sound continues to captivate even the most experienced traveller. At the pinnacle of Milford Sound is the magnetising Mitre Peak - standing a proud 1,692 metres above sea level, it is certainly an impressive sight to behold. Milford Sound is by far the best known of all of the fiords in New Zealand, and the only one that can be accessed by road. It is approximately 16km from the head of the fiord to the open sea, which means visitors can comfortably travel the length of the fiord to open ocean and return on one of the many cruise options. from: http://www.milford-sound.co.nz/about/'),
        );

    // Constructor
    public function __construct() {
        parent::__construct();
    }

    // retrieve a single attraction
    public function get($which) {
        
    // iterate over the data until we find the one we want
        foreach ($this->data as $record)
        {
            if ($record['name'] == $which)
            {
                return $record;
            }
        }
        return null;
    }

    // retrieve all of the attraction
    public function all() {
        return $this->data;
    }

    // retrieve the first attraction
    public function first() {
        return $this->data['glacier'];
    }

    // retrieve the last attraction
    public function last() {
        $index = count($this->data) - 1;
        return $this->data[$index];
    }
    
    //retrieve newest attraction
    public function newest()
    {
        //variable determining if it has the newest date
        $newest = 0;
        //temporary file to store newest record
        $new = 0;
        foreach($this->data as $record)
        {
            //if the record's date is newer than the current, switch.
            if($record['date'] > $newest)
            {
                $newest = $record;
                $new = $record;
            }
        }
        
        return $new;
    }
    
    public function allCategory($which)
    {
        //array we send back 
        $list = array();
        foreach($this->data as $record)
        {
            //if the record's category is the one specified, add to array
            if($record['category'] == $which)
            {
                $list[] = $record;
            }
            
        }
        
        return $list;
    }

}
