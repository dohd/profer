<?php

namespace App\Models\narrative;

use App\Models\narrative\Traits\NarrativeRelationship;
use Illuminate\Database\Eloquent\Model;

class Narrative extends Model
{
    use NarrativeRelationship;    

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'narratives';

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
            $instance->user_id = 1;
            $instance->ins = 1;
            $instance->tid = Narrative::getTid()+1;
            return $instance;
        });

        // static::addGlobalScope('ins', function ($builder) {
        //     $builder->where('ins', '=', auth()->user()->ins);
        // });
    }

    protected static function getTid()
    {
        return Narrative::where('ins', 1)->max('tid');
    }
}
