<?php

namespace Core\Model;

abstract class BaseModel extends SimpleOrm
{
    protected $fillable = [];

    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->$key = $value;
            }
        }

        return $this;
    }

    public function forceFill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }

    public static function fuzzyText(string $term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~', "'", '"'];
        $term = str_replace($reservedSymbols, '', $term);
 
        $words = explode(' ', $term);
 
        foreach ($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if (strlen($word) >= 2) {
                $words[$key] = "'+$word*'";
            }
        }
 
        $searchTerm = implode(' ', $words);
 
        return $searchTerm;
    }
}
