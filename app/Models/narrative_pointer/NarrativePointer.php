<?php

namespace App\Models\narrative_pointer;

use App\Models\narrative_pointer\Traits\NarrativePointerRelationship;
use Illuminate\Database\Eloquent\Model;

class NarrativePointer extends Model
{
    use NarrativePointerRelationship;    

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'narrative_pointers';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [];

    /**
     * Default values for model fields
     * @var array
     */
    protected $attributes = [];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Guarded fields of model
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Constructor of Model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($instance) {
            return $instance;
        });

        // static::addGlobalScope('ins', function ($builder) {
        //     $builder->where('ins', '=', auth()->user()->ins);
        // });
    }
}
