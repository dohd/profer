<?php

namespace App\Models\disability;

use App\Models\disability\Traits\DisabilityAttribute;
use App\Models\disability\Traits\DisabilityRelationship;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    use ModelTrait, DisabilityAttribute, DisabilityRelationship;    

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'disabilities';

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
            $instance->user_id = auth()->user()->id;
            $instance->ins = auth()->user()->ins;
            return $instance;
        });

        static::addGlobalScope('ins', function ($builder) {
            // $builder->where('ins', '=', auth()->user()->ins);
        });
    }
}
