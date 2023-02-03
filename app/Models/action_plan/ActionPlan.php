<?php

namespace App\Models\action_plan;

use App\Models\action_plan\Traits\ActionPlanRelationship;
use Illuminate\Database\Eloquent\Model;

class ActionPlan extends Model
{
    use ActionPlanRelationship;    

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'action_plans';

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
            $instance->ins = 1;
            $instance->user_id = 1;
            $instance->tid = ActionPlan::getTid();
            return $instance;
        });

        // static::addGlobalScope('ins', function ($builder) {
        //     $builder->where('ins', '=', auth()->user()->ins);
        // });
    }

    protected static function getTid()
    {
        return ActionPlan::where('ins', 1)->max('tid');
    }
}
