<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Scope
{
    /**
     * @param Builder $query
     * @param string $email
     * @param string|null $field
     * @return Builder
     */
    public function scopeEmail(Builder $query, string $email, $field = null) : Builder
    {
        return $query->where('email', '=', $email);
    }

    /**
     * @param Builder $query
     * @param boolean $status
     * @param string|null $field
     * @return Builder
     */
    public function scopeStatus(Builder $query, bool $status, $field = null) : Builder
    {
        return $query->where('status', '=', $status);
    }

    /**
     * @param Builder $query
     * @param int $templateId
     * @param string|null $field
     * @return Builder
     */
    public function scopeTemplateId(Builder $query, int $templateId, $field = null) : Builder
    {
        return $query->where('mail_template_id', '=', $templateId);
    }

    /**
     * @param Builder $query
     * @param int $setId
     * @param string|null $field
     * @return Builder
     */
    public function scopeSetId(Builder $query, int $setId, $field = null) : Builder
    {
        return $query->where('delivery_set_id', '=', $setId);
    }

    /**
     * @param Builder $query
     * @param int $visitorId
     * @param string|null $field
     * @return Builder
     */
    public function scopeVisitorId(Builder $query, int $visitorId, $field = null) : Builder
    {
        return $query->where('visitor_id', '=', $visitorId);
    }

}
