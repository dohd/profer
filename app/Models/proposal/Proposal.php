<?php

namespace App\Models\proposal;

use App\Models\proposal\Traits\ProposalRelationship;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use ProposalRelationship;    

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'proposals';

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
            $instance->tid = Proposal::getTid();
            return $instance;
        });

        // static::addGlobalScope('ins', function ($builder) {
        //     $builder->where('ins', '=', auth()->user()->ins);
        // });
    }

    protected static function getTid()
    {
        return Proposal::where('ins', 1)->max('tid');
    }
}
