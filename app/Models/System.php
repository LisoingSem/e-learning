<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class System
 * 
 * @property int $id
 * @property string $name
 * @property string $name_kh
 * @property string $short_name
 * @property string|null $description
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class System extends Model
{
	protected $table = 'systems';

}
