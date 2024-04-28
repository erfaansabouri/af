<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MessageGroup extends Model {
    public function messages (): HasMany {
        return $this->hasMany(Message::class);
    }

    protected static function booted () {
        self::deleted(function ( MessageGroup $message_group ): void {
            $message_group->messages()
                          ->delete();
        });
    }
}
