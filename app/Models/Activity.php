<?php

namespace App\Models;

use App\Models\User;
use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class Activity extends Model
{
    use UuidTrait;

    const UPDATED_AT = null;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_activity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 
        'user_id', 
        'ip_address', 
        'user_agent',
        'device',
        'platform',
        'browser',
        'robot'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Save activity log
     * @param array $data
     * @return booelan ;
     */
    public function log(array $data)
    {
        $agent = new Agent(null, (string) request()->header('User-Agent'));

        if(isset($data['user_id']) == false && auth()->check()){
            $data['user_id'] = auth()->id();
        }

        if(isset($data['ip_address']) == false){
            $data['ip_address'] = request()->ip();
            $data['device'] = $agent->device();
            $data['platform'] = $agent->platform();
            $data['browser'] = $agent->browser();
        }

        return self::create($data);
    }


}
