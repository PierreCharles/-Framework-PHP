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
        $this->bdd[count(self::findAll()) + 20] = array('user' => $user,'message' => $message );
        self::persist();
    }
    public function delete($id)
    {
        if (isset($this->bdd[$id])) {
            unset($this->bdd[$id]);
            self::persist();
        }
    }
    private function persist()
    {
        file_put_contents($this->filePath, json_encode($this->bdd));
    }

    // Error undefind
    private function getMaxId(){
        $max=0;
        foreach($this->bdd as $value){
            if($value > $max) $max=$value;
        }
        return $max;
    }
}
