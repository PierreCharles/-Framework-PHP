<?php
namespace Model;
class JsonFinder implements FinderInterface
{
    private $filePath = __DIR__ . 'bdd.json';
    private $bdd;
    
    public function __construct()
    {
        $this->bdd = json_decode(file_get_contents($this->filePath), true);
    }
    /**
     * @return array
     */
    public function findAll()
    {
        return $this->bdd;
    }
    /**
     *
     * @param  mixed $id
     * @return null|mixed
     */
    public function findOneById($id)
    {
        return $this->bdd[$id - 1] ?? null;
    }
    public function add($data)
    {
        $this->bdd[] = $data;
    }
    public function remove($id)
    {
        if (isset($this->bdd[$id - 1])) {
            unset($this->bdd[$id - 1]);
        }
    }
    public function persist()
    {
        file_put_contents($this->filePath, json_encode($this->bdd));
    }
}
