<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $table = 'projects';
  protected $primaryKey = 'project_id';
  protected $fillable = ['project_id', 'createdBy','title', 'description'];

  public static function refresh_all_artifacts_from_teamforge()
  {
    $url = 'https://teamforge.srv247.se/ctfrest/foundation/v1/projects';
    $options=array(
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
      \Log::warning('failed to refresh_all_artifacts_form_teamforge()');
    }

    return null;
  }
}
