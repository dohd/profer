<?php

namespace App\Models\memberlist;

use App\Models\memberlist\Traits\MemberlistAttribute;
use App\Models\memberlist\Traits\MemberlistRelationship;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Memberlist extends Model
{
    use ModelTrait, MemberlistAttribute, MemberlistRelationship;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'memberlists';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'dfname_id',
        'family_name',
        'proposal_id',
        'action_plan_id',
        'proposal_item_id',
        'date',
        'male_total',
        'female_total',
        'grand_total',
        'doc_file',
        'prepared_by',
        'user_id',
        'ins'
    ];

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
            $instance['user_id'] = auth()->user()->id;
            $instance['ins'] = auth()->user()->ins;
            return $instance;
        });

        static::addGlobalScope('ins', function ($builder) {
            // $builder->where('ins', '=', auth()->user()->ins);
        });
    }
}
