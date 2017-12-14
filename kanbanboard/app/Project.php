<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Auth\TeamForgeApiToken;

class Project extends Model
{
  protected $table = 'projects';
  public $incrementing = false;
  protected $primaryKey = 'project_id';
  protected $fillable = ['project_id', 'createdBy','title', 'description', 'artifact_fetch'];

  public static function refresh_all_projects_from_teamforge()
  {
    $url = config('teamforge.url') . '/ctfrest/foundation/v1/projects';
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

      foreach ($results->items as $item) {
        $temp = Project::firstOrNew(array('project_id' => $item->id));
        $temp->createdBy = $item->createdBy;
        $temp->title = $item->title;
        $temp->description = $item->description;
        $temp->save();
      }
    } catch (\Exception $e) {
      \Log::warning('failed to refresh_all_failed_form_teamforge()');
    }

    return null;
  }
}
