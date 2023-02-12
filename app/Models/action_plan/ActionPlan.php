<?php

namespace App\Models\action_plan;

use App\Models\action_plan\Traits\ActionPlanAttribute;
use App\Models\action_plan\Traits\ActionPlanRelationship;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class ActionPlan extends Model
{
    use ModelTrait, ActionPlanAttribute, ActionPlanRelationship;    

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
            $instance->fill([
                'tid' => $instance->next_tid,
                'user_id' => 1,
                'ins' => 1,
            ]);
            return $instance;
        });

        static::addGlobalScope('ins', function ($builder) {
            // $builder->where('ins', '=', auth()->user()->ins);
        });
    }
}
