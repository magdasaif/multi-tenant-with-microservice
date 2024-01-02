<?php

namespace App\Models;
use Stancl\Tenancy\Events\TenantSaved;
use Stancl\Tenancy\Events\SavingTenant;
use Stancl\Tenancy\Events\TenantCreated;
use Stancl\Tenancy\Events\TenantDeleted;
use Stancl\Tenancy\Events\TenantUpdated;
use Stancl\Tenancy\Events\CreatingTenant;
use Stancl\Tenancy\Events\DeletingTenant;
use Stancl\Tenancy\Events\UpdatingTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasFactory;
    use HasDatabase, HasDomains;
    protected $fillable = [
        'id',
        'tenancy_db_names',
        'data'
    ];
    #================================================#
    //events from extends BaseTenant
    protected $dispatchesEvents = [
        'saving'    => SavingTenant::class,
        'saved'     => TenantSaved::class,
        'creating'  => CreatingTenant::class,
        'created'   => TenantCreated::class,
        'updating'  => UpdatingTenant::class,
        'updated'   => TenantUpdated::class,
        'deleting'  => DeletingTenant::class,
        'deleted'   => TenantDeleted::class,
    ];
    #================================================#
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'tenancy_db_names',
            // 'app',
            // 'app_type',
            'data',
            // 'test'
        ];
    }
    #================================================#
}
