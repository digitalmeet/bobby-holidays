<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            ActivityLog::log($model, 'created', class_basename($model) . ' created');
        });

        static::updated(function ($model) {
            $dirty = $model->getDirty();
            $original = collect($model->getOriginal())->only(array_keys($dirty))->toArray();

            // Skip if only timestamps changed
            $meaningful = collect($dirty)->except(['updated_at', 'created_at'])->toArray();
            if (empty($meaningful)) {
                return;
            }

            ActivityLog::log(
                $model,
                'updated',
                'Updated: ' . implode(', ', array_keys($meaningful)),
                $original,
                $meaningful
            );
        });

        static::deleted(function ($model) {
            $action = method_exists($model, 'trashed') && $model->trashed() ? 'soft_deleted' : 'deleted';
            ActivityLog::log($model, $action, class_basename($model) . ' deleted');
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                ActivityLog::log($model, 'restored', class_basename($model) . ' restored');
            });
        }
    }

    /**
     * Get activity logs for this record.
     */
    public function activityLogs()
    {
        return ActivityLog::getLogsFor($this);
    }
}
