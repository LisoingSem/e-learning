<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Agency
 * 
 * @property int $id
 * @property string|null $name_en
 * @property string|null $name_kh
 * @property string|null $registration_no
 * @property Carbon|null $registration_date
 * @property string|null $phone_number
 * @property string|null $address
 * @property int $active
 * @property int|null $created_by
 * @property Carbon|null $created_at
 * @property int|null $updated_by
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Agency extends Model
{
	protected $table = 'agencies';

}
