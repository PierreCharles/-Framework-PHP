<?php
namespace Model;
class JsonFinder implements FinderInterface
{
    private $filePath = __DIR__ .DIRECTORY_SEPARATOR.'Data/bdd.json';
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
		
        $this->bdd = json_decode(file_get_contents($this->filePath), true);
        return $this->bdd;
    }
    /**
     *
     * @param  mixed $id
     * @return null|mixed
     */
    public function findOneById($id)
    {
        return $this->bdd[$id] ?? null;
    }
    
    public function add($user,$message)
    {
        array_push($this->bdd,array('user'=>$user,'message'=>$message));
    }
    public function remove($id)
    {
        if (isset($this->bdd[$id])) {
            unset($this->bdd[$id]);
        }
    }
    public function persist()
    {
        file_put_contents($this->filePath, json_encode($this->bdd));
    }
}
