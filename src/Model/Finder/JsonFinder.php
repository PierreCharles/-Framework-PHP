<?php

namespace Model\Finder;

class JsonFinder implements FinderInterface
{
    private $filePath = __DIR__.'/../Data/bdd.json';
    private $bdd;

    public function __construct()
    {
        $this->bdd = json_decode(file_get_contents($this->filePath), true);
    }

    /**
     * @param $filter
     *
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
        return $this->bdd[$id] ?? null;
    }

    public function add($user, $message)
    {
        $id = $this->getMaxId() + 1;
        $this->bdd[$id] = array('id' => $id, 'user' => $user, 'message' => $message);
        $this->persist();
    }
    public function delete($id)
    {
        if (isset($this->bdd[$id])) {
            unset($this->bdd[$id]);
            $this->persist();
        }
    }
    private function persist()
    {
        file_put_contents($this->filePath, json_encode($this->bdd));
    }

    private function getMaxId()
    {
        $max = 0;
        foreach ($this->bdd as $status) {
            if ($status['id'] > $max) {
                $max = $status['id'];
            }
        }

        return $max;
    }
}
