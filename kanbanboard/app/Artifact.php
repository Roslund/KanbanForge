<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Auth\TeamForgeApiToken;

class Artifact extends Model
{
  protected $table = 'artifacts';
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $fillable = ['title','createdDate','status','description','assignedTo'];


  public static function refresh_all_artifacts_from_teamforge()
  {
    $url = config('teamforge.url') . '/ctfrest/tracker/v1/artifacts?includeIconLinks=false';
    $options=array(
      'http' => array(
        'header'  => "Authorization: Bearer " . TeamForgeApiToken::getToken() . "\r\n",
        'method'  => 'GET',
      ),
      "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
      ),
    );
    try {
      $contents = file_get_contents($url, false, stream_context_create($options)); 
      $contents = utf8_encode($contents); 
      $results = json_decode($contents); 

      \Log::info($results->items);
      foreach ($results->items as $item) {
        $temp = Artifact::firstOrNew(array('id' => $item->id));
        $temp->createdDate = $item->createdDate;
        $temp->title = $item->title;
        $temp->status = $item->status;
        $temp->description = $item->description;
        $temp->assignedTo = $item->assignedTo;
        $temp->save();
      }
    } catch (\Exception $e) {
    	\Log::info($e);
      \Log::warning('failed to refresh_all_artifacts_from_teamforge()');
    }

    return null;
  }
}
