<?php

namespace Model\Finder;

class InMemoryFinder implements FinderInterface
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = array(
            '1' => array(
                'id' => '1',
                'message' => 'TweetTweet',
                'user' => 'picharles',
            ), );
    }

    /**
     * @param $filter
     * @return array
     */
    public function findAll($filter)
    {
        return $this->bdd;
    }
    /**
     * @param mixed $id
     *
     * @return null|mixed
     */
    public function findOneById($id)
    {
        if (!array_key_exists($id, $this->bdd)) {
            return;
        }

        return $this->bdd[$id];
    }
}
