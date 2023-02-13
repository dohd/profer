<?php

namespace App\Models\participant_list;

use App\Models\ModelTrait;
use App\Models\participant_list\Traits\ParticipantListAttribute;
use App\Models\participant_list\Traits\ParticipantListRelationship;
use Illuminate\Database\Eloquent\Model;

class ParticipantList extends Model
{
    use ModelTrait, ParticipantListAttribute,ParticipantListRelationship;    

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'participant_lists';

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
