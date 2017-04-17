<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Shpop3x;
use App\Check;
use Carbon\Carbon;
use App\Target;

class Email extends Model {

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emails';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'pass', 'user_id', 'pop3', 'port'];

    static function getValidationRules() {
        return array(
            'email' => 'required|email',
            'user_id' => 'required|exists:users,id',
            'pass' => 'required|min:6',
            'pop3' => 'required',
            'port' => 'required|numeric|max:9999|min:0'
        );
    }

    public function receiveLetters(){
        $last_time = Carbon::createFromFormat('Y-m-d H:i:s', Check::all()->last()->time);

		$imap = Shpop3x::create($this->pop3, $this->email, $this->pass, $this->port);
		$imap->connect();

		$flag = true;
		$i = 0;
		while($flag){
			$i++;

			if($imap->totalEmail() < $i) break;
			$msg = $imap->readMail($i);
			$msg_date = $msg->getDate('Y-m-d H:i:s');
			$msg_date = Carbon::createFromFormat('Y-m-d H:i:s', $msg_date);

			if($msg_date->lte($last_time)) continue;
			$t = base64_decode($msg->getBody('text', false));

			preg_match_all('/місцезнаходження: \b(?<name>[\w|\s|,]+)Для/u', $t, $target_title);

			$target_title = $target_title['name'][0];
			$target_array = preg_split('/, /', $target_title);
			$place = trim(end($target_array));

			$targets = Target::where('title', $place)->get();
			$target_id = 0;
			foreach($targets as $target){
				$trace = $target->hasOne('App\Trace', 'id', 'trace_id')->first();
                if($trace->email_id != $this->id) continue;
				$start_at = Carbon::createFromFormat('Y-m-d H:i:s', $trace->start);
				$finish_at = Carbon::createFromFormat('Y-m-d H:i:s', $trace->finish);
				if($start_at->lt($msg_date) && $msg_date->lt($finish_at)){
					$target_id = $target->id;
					break;
				}
			}

			$check = array();
			$check['target_id'] = $target_id;
			$check['target_title'] = trim($target_title);
			$check['time'] = $msg_date;

			if($target_id != 0) $check['checked'] = true;
			preg_match('/\d{10}/', $t, $number);
			$check['phone'] = $number[0];

			Check::create($check);
			Trace::checkActive();
		}
    }

}
