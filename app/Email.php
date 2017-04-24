<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Shpop3x;
use App\Check;
use Carbon\Carbon;
use App\Target;
use App\Member;

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

	protected $dates = ['created_at', 'updated_at'];

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
        $last_time = Check::all()->last()->time;

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
			
			preg_match('/\d{10}/', $t, $number);
			$number = $number[0];
			
			// вибрати унікальні траси, на які їде цей телефон і взяти ті таргет, що
			// відносяться до цієї траси, потім перевірка на тайтл і запис в чек
			
			$members = Member::where('phone', $number)->get();
			$traces = collect();
			foreach($members as $member){
				$trs = $member->belongsToMany('App\Trace', 'registered', 
      						'member_id', 'trace_id')->get();
				$traces = $traces->merge($trs);
			}

			$targets = Target::where('finish', '>', $msg_date)->where('start', '<', $msg_date)
							 ->whereIn('trace_id', $traces->lists('id'))->where('title', $place)
							 ->get();
			$target_id = 0;

			if($targets->count() > 0) $target_id = $targets->first()->id;

			$check = array();
			$check['target_id'] = $target_id;
			$check['target_title'] = trim($target_title);
			$check['time'] = $msg_date;

			if($target_id != 0) $check['checked'] = true;
			
			$check['phone'] = $number;

			Check::create($check);
		}
    }

}
