<?php

namespace App\Models\action_plan;

use App\Models\action_plan\Traits\ActionPlanCohortRelationship;
use Illuminate\Database\Eloquent\Model;

class ActionPlanCohort extends Model
{
    use ActionPlanCohortRelationship;    

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'action_plan_cohorts';

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
    }
}
