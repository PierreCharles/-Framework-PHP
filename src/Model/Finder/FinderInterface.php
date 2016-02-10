<?php

namespace Model\Finder;

interface FinderInterface
{
    /**
     * Returns all elements.
     * 
     * @param $filter
     * @return array .
     */
    public function findAll($filter);

    /**
     * Retrieve an element by its id.
     *
     * @param mixed $id
     *
     * @return null|mixed
     */
    public function findOneById($id);
}
