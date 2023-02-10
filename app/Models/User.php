<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->when($filters['active'] ?? false, function($query, $active){
            $query->where('active', '=' , DB::raw($active));
        })
        ->when($filters['type'] ?? false, function($query, $type){
            $query->whereHas('role', function($query) use ($type){
                $query->where('role_name', '=', $type);
            });
        })
        ->when($filters['incidence'] ?? false, function($query, $subject){
            $query->whereHas('incidences', function($query) use ($subject){
                $query->where(function($query) use ($subject){
                    $query->where('subject', $subject)->where('date', DB::raw('CURDATE()'));
                });
            });
        })
        ->when($filters['date'] ?? false, function($query, $date){
            $query->with('files', function($query) use ($date) {
                $query->where('date', $date);
            })
            ->with('incidences', function($query) use ($date) {
                $query->where('date', $date);
            })
            ->whereHas('ranges', function($query) use ($date){
                $query->where(function($query) use ($date) {
                    $query->whereRaw("'$date' between `start_date` and `end_date`");
                })
                ->whereHas('schedule', function($query) use ($date) {
                    $query->whereRaw("dayname('$date') = `schedules`.`day`");
                });
            });
        }, function($query){
            $query->with(['files' => function($query){
                $query->where('date', DB::raw('CURDATE()'))->orderBy('timestamp');
            },
            'incidences' => function($query){
                $query->where('date', DB::raw('CURDATE()'));
            }])
            ->where('active', DB::raw('true'))
            ->whereHas('ranges', function($query){
                $query->where(function($query){
                    $query->whereRaw("curdate() between `start_date` and `end_date`");
                })
                ->whereHas('schedule', function($query){
                    $query->whereRaw("dayname(curdate()) = `schedules`.`day`");
                });
            });
        });
    }

    public function permits()
    {
        return $this->hasMany(Permit::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function ranges()
    {
        return $this->belongsToMany(DateRange::class);
    }

    public function incidences()
    {
        return $this->hasMany(Incidence::class);
    }
}
