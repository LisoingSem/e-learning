<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $name_en
 * @property string $name_kh
 * @property float $price
 * @property int $active
 * @property int|null $created_by
 * @property Carbon|null $created_at
 * @property int|null $updated_by
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';

}
