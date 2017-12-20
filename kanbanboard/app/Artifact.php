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
    //Get projects we will fetch artifacts from.
    $projIDtoFetch = array();
    foreach (\App\Project::where('artifact_fetch', 1)->get() as $key => $artifact) {
      $projIDtoFetch[] = $artifact->project_id;
    }

    //If no projects are selected, removed all artifacts from database and stop.
    if(empty($projIDtoFetch)){
      foreach (Artifact::all() as $artifact) {
        $artifact->delete();
      }
      return null;
    }

    $postdata = json_encode((object)array(
     'containerIds' => $projIDtoFetch,
      'includeSubprojects' => true,
      'sortBy' => '',
      'filters' => (object)array(),
      'details' => array(),
    ));

    $url = config('teamforge.url') . '/ctfrest/tracker/v1/artifacts/filter';
    $options=array(
      'http' => array(
        'header'  => "Authorization: Bearer " . TeamForgeApiToken::getToken() . "\r\n" .
                     "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => $postdata
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

      $newArtifacts = array();
      foreach ($results->items as $item) {
        $temp = Artifact::firstOrNew(array('id' => $item->id));
        $temp->id = $item->id;
        $temp->createdDate = $item->createdDate;
        $temp->title = $item->title;
        $temp->status = $item->status;
        $temp->description = $item->description;
        $temp->assignedTo = $item->assignedTo;
        $temp->save();
        $newArtifacts[] = $temp;
      }

      //Delete artifacts that are not in database.
      if(!empty($newArtifacts)){
        $artifactsInDatabase = Artifact::all();
        $artifactsToRemove = $artifactsInDatabase->diff($newArtifacts);
        foreach ($artifactsToRemove as $artifactToRemove) {
          $artifactToRemove->delete();
        }
      }

    } catch (\Exception $e) {
      \Log::info($e);
      \Log::warning('failed to refresh_all_artifacts_from_teamforge()');
    }

    return null;
  }

  public static function get_artifact_by_id($artifactId, $includeKeys = null)
  {
    $url = config('teamforge.url') . '/ctfrest/tracker/v1/artifacts/' . $artifactId;
    $options=array(
      'http' => array(
        'header'  => "Authorization: Bearer " . TeamForgeApiToken::getToken() . "\r\n" .
                     "Content-type: application/json\r\n",
        'method'  => 'GET',
        'timeout' => 5 // 5 second timeout
      ),
      "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
      ),
    );

    try {
      $contents = file_get_contents($url, false, stream_context_create($options));

      if($contents !== null)
      {
        $contents = utf8_encode($contents);
        $result = json_decode($contents, true);

        if($includeKeys == null) {
            return $result;
        }
        else {
          // This filters out all other keys than the ones specified in $includeKeys.
          // This removes sensetive or unimportant api related variables from the return value.
          // (It also keeps values added in the future hidden until they actually need to be shown)
          $returnValue = array();

          foreach($result as $key => $value) {
            if(in_array($key, $includeKeys)) {
              $returnValue[$key] = $result[$key];
            }
          }

          return $returnValue;
        }
      }
      else {
        return null;
      }

    } catch (\Exception $e) {
      \Log::warning('failed to get_artifact_by_id()');
      return null;
    }
  }
}
