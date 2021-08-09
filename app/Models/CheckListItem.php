<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckListItem extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'check_list_id', 'checked', 'order'];

    public function list()
    {
        return $this->belongsTo(CheckList::class);
    }

    public function check()
    {
        $this->checked = true;
        $this->save();
        return $this;
    }
}
