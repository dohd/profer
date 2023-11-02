<?php

namespace App\Models\document_import;

use App\Models\document_import\Traits\DocumentImportAttribute;
use App\Models\document_import\Traits\DocumentImportRelationship;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class DocumentImport extends Model
{
    use ModelTrait, DocumentImportAttribute, DocumentImportRelationship;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'document_imports';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'name',
        'date',
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
            $instance->user_id = auth()->user()->id;
            $instance->ins = auth()->user()->ins;
            return $instance;
        });

        static::addGlobalScope('ins', function ($builder) {
            $builder->where('ins', auth()->user()->ins);
        });
    }
}
