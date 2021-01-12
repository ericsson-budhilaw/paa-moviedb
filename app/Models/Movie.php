<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'poster',
        'description',
        'year',
        'writer'
    ];

    /**
     * Sorted data by release date (year).
     * This method using Selection Sort
     *
     * @author Ericsson Budhilaw
     */
    public function selectionSort($data, $rule)
    {
        for($i = 0; $i < count($data)-1; $i++) {
            $min = $i;
            for($j = $i+1; $j < count($data); $j++) {
                if($rule) {
                    if($data[$j]->year < $data[$min]->year) {
                        $min = $j;
                    }
                } else {
                    if($data[$j]->year > $data[$min]->year) {
                        $min = $j;
                    }
                }
            }
            $data = $this->swapPosition($data, $i, $min);
        }
        return $data;
    }

    /**
     * Swap data position by index.
     * For Selection Sort.
     *
     * @author Ericsson Budhilaw
     */
    public function swapPosition($data1, $left, $right)
    {
        $backup_data    = $data1[$right];
        $data1[$right]  = $data1[$left];
        $data1[$left]   = $backup_data;
        return $data1;
    }

    /**
     * Search data by release data.
     * Data must be sorted first.
     *
     * @author Ericsson Budhilaw
     */
    public function binarySearch($data, $keyword)
    {
        $data = $this->selectionSort($data, true);

        if (count($data) === 0) return false;
        $low = 0;
        $high = count($data) - 1;

        while ($low <= $high)
        {
            $mid = floor(($low + $high) / 2);

            if($data[$mid]->year == $keyword)
            {
                return $data[$mid]->id;
            }

            if ($keyword < $data[$mid]->year)
            {
                $high = $mid -1;
            }
            else
            {
                $low = $mid + 1;
            }
        }

        return -1;
    }

    /**
     * Search data by Title.
     *
     * @author Ericsson Budhilaw
     */
    public function linearSearch($data, $keyword)
    {
        $n = sizeof($data);
        for($i = 0; $i < $n; $i++)
        {
            if(Str::contains(strtolower($data[$i]->title), $keyword)) return $data[$i]->id;
        }
        return -1;
    }
}
