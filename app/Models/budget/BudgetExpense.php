<?php

namespace App\Models\budget;

use App\Models\budget\Traits\BudgetExpenseRelationship;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class BudgetExpense extends Model
{
    use ModelTrait, BudgetExpenseRelationship;
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'budget_expenses';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'budget_id',
        'item_category_id',
        'cost_item_id',
        'date',
        'amount',
        'user_id', 
        'ins',
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
}
