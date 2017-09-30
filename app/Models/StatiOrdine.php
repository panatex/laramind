<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 30 Sep 2017 15:03:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StatiOrdine
 * 
 * @property int $id
 * @property string $nome_stato
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ordinis
 *
 * @package App\Models
 */
class StatiOrdine extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'stati_ordine';

	protected $fillable = [
		'nome_stato'
	];

	public function ordinis()
	{
		return $this->hasMany(\App\Models\Ordini::class);
	}
}
