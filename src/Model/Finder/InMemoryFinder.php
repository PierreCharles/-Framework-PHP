<?php

namespace Model\Finder;

class InMemoryFinder implements FinderInterface
{
    private $bdd;
    
    public function __construct() {
        $this->bdd = array(
            '1' => array(
                'id' => '1',
                'message' => 'TweetTweet',
                'user' => 'picharles',
            ));
    }
    
    /**
     * @return array
     */
    public function findAll()
    {
        return $this->bdd;
    }
    /**
     * @param  mixed $id
     * @return null|mixed
     */
    public function findOneById($id)
    {
        if (!array_key_exists($id, $this->bdd)) {
            return null;
        }
        return $this->bdd[$id];
    }
}
