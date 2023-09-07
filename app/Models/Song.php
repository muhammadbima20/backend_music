<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'song_name',
        'artist_name',
        'cover_image',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['is_saved'];

    protected function isSaved(): Attribute
    {
        return new Attribute(
            get: function() {
                $saved = UserSong::where('song_id', $this->id)->where('user_id', Auth::user()->id)->first();
                return empty($saved) ? 0 : 1;
            }
        );
    }

}
