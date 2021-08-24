<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
    use HasFactory;


    public function items()
    {
        return $this->hasMany(CheckListItem::class);
    }

    //converts array to checklist
    public static function arrayToChecklist(array $array)
    {
        $checklist = CheckList::create([]);
        foreach ($array as $key => $item) {
            $checklist->items()->create([
                'content' => $item,
                'order' => $key + 1
            ]);
        }
        $checklist->save();
        return $checklist;
    }


    //returns last item order
    public function lastOrder()
    {
        return $this->items()->orderByDesc('order')->first()->order ?? 0;
    }
}
