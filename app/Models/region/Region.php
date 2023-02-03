<?php

namespace App\Models\region;

use App\Models\region\Traits\RegionRelationship;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use RegionRelationship;    

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'regions';

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
            // $instance->user_id = 1;
            // $instance->ins = 1;
            return $instance;
        });

        // static::addGlobalScope('ins', function ($builder) {
        //     $builder->where('ins', '=', auth()->user()->ins);
        // });
    }
}
