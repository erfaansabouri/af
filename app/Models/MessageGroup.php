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
        self::created(function ( MessageGroup $message_group ): void {
            $items = [];
            foreach ( Tenant::all() as $tenant ) {
                $items[] = [
                    'tenant_id' => $tenant->id ,
                    'message_group_id' => $message_group->id ,
                    'message' => $message_group->message ,
                    'created_at' => now() ,
                    'updated_at' => now() ,
                ];
            }
            Message::query()
                   ->insert($items);
        });
        self::updated(function ( MessageGroup $message_group ): void {
            $message_group->messages()
                          ->update([
                                       'message' => $message_group->message ,
                                   ]);
        });
    }
}
