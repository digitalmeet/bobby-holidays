<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public $timestamps = false;

    private static array $checkedTables = [];

    protected $fillable = [
        'record_id',
        'user_id',
        'action',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'created_at',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Set table dynamically based on module.
     */
    public static function forModule(string $module): self
    {
        $instance = new static;
        $instance->setTable("{$module}_logs");
        return $instance;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Log an activity for any model.
     */
    public static function log(Model $model, string $action, ?string $description = null, ?array $oldValues = null, ?array $newValues = null): ?self
    {
        $module = static::getModuleFromModel($model);
        $table = "{$module}_logs";

        // Use config-based check instead of Schema::hasTable() for performance
        if (!in_array($table, config('activity-log.tables', []))) {
            return null;
        }

        $log = new static;
        $log->setTable($table);
        $log->fill([
            'record_id' => $model->id,
            'user_id' => auth()->id(),
            'action' => $action,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()?->ip(),
            'created_at' => now(),
        ]);
        $log->save();

        return $log;
    }

    /**
     * Get all logs for a specific record.
     */
    public static function getLogsFor(Model $model)
    {
        $module = static::getModuleFromModel($model);
        $table = "{$module}_logs";

        return static::query()
            ->from($table)
            ->where('record_id', $model->id)
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * Derive module name from model class.
     */
    private static function getModuleFromModel(Model $model): string
    {
        return str(class_basename($model))->snake()->toString();
    }
}
