<?php

namespace App\Models\item;

use App\Models\item\Traits\BudgetItemRelationship;
use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{  
    use BudgetItemRelationship;
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'budget_items';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'budget_id',
        'proposal_item_id',
        'type',
        'name',
        'budget',
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
    }
}
