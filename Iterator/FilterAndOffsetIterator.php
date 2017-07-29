<?php

/**
 * Created by IntelliJ IDEA.
 * User: ignatius
 * Date: 22/08/15
 * Time: 14:15
 */
class EntryCollection implements Iterator
{
    private $entries = [];
    private $pointer = 0;
    private $offset = 0;

    /**
     * @param Entry $entry
     * @return $this
     */
    public function addEntry(Entry $entry){
        $this->entries[] = $entry;
        return $this;
    }

    /**
     * @param int $offset
     * @return EntryCollection
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }


    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->entries[$this->pointer];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {

        do $this->pointer++;
        while(isset($this->entries[$this->pointer]) && !$this->entries[$this->pointer]->isIterable());
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
       return $this->pointer;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset($this->entries[$this->pointer]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->pointer = $this->offset;
    }

}

class Entry{
    private $iterable;
    private $value;
    public function __construct($value, $iterable = TRUE){
        $this->iterable = $iterable;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function isIterable()
    {
        return $this->iterable;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}


$iterator = (new EntryCollection)
    ->setOffset(1)
    ->addEntry(new Entry('entry 1'))
    ->addEntry(new Entry('entry 2'))
    ->addEntry(new Entry('entry 3'))
    ->addEntry(new Entry('entry 4', FALSE))
    ->addEntry(new Entry('entry 5'));

foreach ($iterator as $key => $entry) {
    echo $key.' '.$entry->getValue().PHP_EOL;
}