@extends('layouts.kanbanboard')

@section('head')

<title>Board</title>

@endsection

@section('content')

<h1>Kanban Board</h1>
<hr>

<div class="tbl-board">
  @if(count($categories) > 0)
  <table id="table-data" cellpadding="0" cellspacing="0" border="0">
    <thead>
      @if(count($parentCategories) > 0)
          <?php
            $last = -1;
            $counter = -1;
            $parentCategoriesOrder = array();
          ?>
          @foreach($categories as $category)
            <?php
              if($last != $category['parentcategory']) {
                $counter++;
                $parentCategoriesOrder[$counter] = [ "value" => $category['parentcategory'], "count" => 1, "inGroup" => $category['id'] ];
              }
              else {
                $parentCategoriesOrder[$counter]["count"]++;

                if($parentCategoriesOrder[$counter]["inGroup"] == "") {
                  $parentCategoriesOrder[$counter]["inGroup"] = $category['id'];
                }
                else {
                  $parentCategoriesOrder[$counter]["inGroup"] .= ",".$category['id'];
                }
              }
              $last = $category['parentcategory'];
            ?>
          @endforeach

          @if(count($parentCategoriesOrder) > 1 || (count($parentCategoriesOrder) == 1 && $parentCategoriesOrder[0]['value'] != null))
            <tr>
              <th class="empty-th"></th>
            @foreach($parentCategoriesOrder as $group)
              @if(!(is_null($group['value'])))
                <th colspan="{{$group['count']}}"
                    group="{{$group['inGroup']}}"
                    limit="{{$parentCategories[$group['value']]['limit']}}"
                    class="parentCategoryHeader">

                  {{ $parentCategories[$group['value']]['name'] }}<br>
                  <span class="limit">Limit: {{ $parentCategories[$group['value']]['limit'] }}</span>
              @else
                <th colspan="{{$group['count']}}">
              @endif
                </th>
            @endforeach
            </tr>
          @endif
      @endif

      <tr>
        <th class="empty-th"></th>
        @foreach($categories as $category)
          <th class="categoryHeader" category_id="{{$category['id']}}" limit="{{ $category['limit'] }}">
            {{ $category["name"] }}<br>
            <span class="limit">Limit: {{ $category["limit"] }}</span>
          </th>
        @endforeach
      </tr>
    </thead>

    <tbody>
      @foreach($swimlanes as $swimlane)
        <tr>
        <th>{{ $swimlane["name"] }}</th>
        @foreach($categories as $category)
          <td id="c{{$category['id']}}s{{$swimlane['id']}}" category_id='{{$category["id"]}}' swimlane_id='{{$swimlane["id"]}}' ondrop ="drop(event)" ondragover="allowDrop(event)" class="card-td">
            @foreach($cards as $card)
              @if($card["swimlane_id"] == $swimlane["id"] && $card["category_id"] == $category["id"])
              <div class='card' id="card{{$card['id']}}" title="{{$card['title']}}" card_id="{{$card['id']}}" draggable="true" ondragstart="drag(event)">
                <a onclick="cardModal({{ $card['id'] }})" href="#">
                <?php
                  $wordCutoff = 5;
                  if(str_word_count($card["title"]) > $wordCutoff)
                  {
                    echo implode(' ', array_slice(explode(' ', $card["title"]), 0, $wordCutoff)) . "...";
                  }
                  else {
                    echo implode(' ', array_slice(explode(' ', $card["title"]), 0, $wordCutoff));
                  }
                ?>
                </a><br>
                Assigned to: {{ $card["assignedTo"] }}<br>
                Last updated:<br>
                <span class="cardLastUpdated">
                <?php
                  $cardLastUpdate = new DateTime($card['updated_at']);
                  $currentDate = new DateTime(date("Y-m-d H:i:s"));
                  $dateInterval = $cardLastUpdate->diff($currentDate);

                  $stringValue = $dateInterval->format('%d days ago');
                  if($stringValue == "0 days ago") {
                    echo "Today";
                  }
                  else {
                    echo $stringValue;
                  }
                ?>
                </span>
              </div>
              @endif
            @endforeach
          </td>
        @endforeach
      </tr>
      @endforeach

      <tr>
        <th>&nbsp;</th>
        @foreach($categories as $category)
          <td id="c{{$category['id']}}snull" category_id='{{$category["id"]}}' swimlane_id='null' ondrop ="drop(event)" ondragover="allowDrop(event)" class="card-td">
            @foreach($cards as $card)
              @if(is_null($card["swimlane_id"]) && $card["category_id"] == $category["id"])
              <div class='card' id="card{{$card['id']}}" card_id="{{$card['id']}}" draggable="true" ondragstart="drag(event)">
                <a onclick="cardModal({{ $card['id'] }})" href="#">
                Card {{ $card["id"] }}
                </a><br>
                Assigned to: {{ $card["assignedTo"] }}<br>
                Last updated:<br>
                <span class="cardLastUpdated">
                <?php
                  $cardLastUpdate = new DateTime($card['updated_at']);
                  $currentDate = new DateTime(date("Y-m-d H:i:s"));
                  $dateInterval = $cardLastUpdate->diff($currentDate);

                  $stringValue = $dateInterval->format('%d days ago');
                  if($stringValue == "0 days ago") {
                    echo "Today";
                  }
                  else {
                    echo $stringValue;
                  }
                ?>
                </span>
              </div>
              @endif
            @endforeach
          </td>
        @endforeach
      </tr>
    </tbody>
  </table>

  @else
  <h3>The administrator hasn't defined a board, please wait for them to do</h3>
  @endif

</div>

<!-- Card Modal -->
    <div class="modal fade" id="cardModal" tabindex="-1" role="dialog" aria-labelledby="Create" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="cardModalTitle">Card Title</h2>
          </div>
          <hr>
          <div class="modal-body" id="cardModalBody">
            <div class="table">
              <table class="table table-bordered table-striped table-hover table-fixed">
                <thead>
                  <tr>
                    <th colspan="2">DB</th>
                  </tr>
                  <tr>
                    <th>Key</th>
                    <th>Value</th>
                  </tr>
                </thead>
                <tbody id="cardModalBodyTable">

                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

@endsection

{{--
    the section below is for the includes related to the kanban board
    if we decide that all styling for the board should reside in a spearate file
    we can move it over there instead
    this is the easiest solution i came up with to make the imports for the board work
    while at the same time avoiding to have them included in all other pages using app.blade.php
    the kanbanBoardJs section is only defined in the kanban board
--}}

@section('kanbanBoardIncludes')

<!-- Kanban Board imports -->
<script src="{{URL::asset('js/kanbanBoard/boardFunctionality.js')}}"></script>

<script type="text/javascript">
  // Card Modals
  function cardModal(id)
  {
    $.ajax({ url: "/api/cards/" + id,
    method: "GET",
    success: function( result ) {
      var modal = $("#cardModalBodyTable");

      modal.empty();

      $.each(result['dbValues'], function(key, value) {
        modal.append("<tr><td>"+key+"</td><td>"+value+"</td></tr>");
        //console.log(key + ": " + value);
      });

      if(result['teamforgeValues'] != null) {
        $("#cardModalTitle").text(result['teamforgeValues'].title);

        $.each(result['teamforgeValues'], function(key, value) {
          if (key == "flexFields") {
            var rows = $(modal).children().toArray();

            $.each(value, function(k, v) {
              modal.append("<tr><td>"+v.name+"</td><td>"+v.values[0]+"</td></tr>");
            });

            return true;
          }
          modal.append("<tr><td>"+key+"</td><td>"+value+"</td></tr>");
        });
      }
      else {
        $("#cardModalTitle").text(result['dbValues'].title);
      }

      $("#cardModal").modal('toggle');
    },
    error: function() {
      alert("Card details couldn't be fetched!");
    }
    });
  }

  $(document).ready(function() {
    checkLimits();
  });

</script>

<!-- This is to inject the current server timestamp into the boardTimestamp variable -->
<!-- Can't inject it directly into the javascript as it doesn't get compiled with blade -->
<!-- This needs to be done after the javascript above has loaded in, which is why it's under it -->
<script type="text/javascript">
  boardTimestamp = "{{date('Y-m-d H:i:s')}}";
  metadataObject = { 'categoryCount': {{count($categories)}}, 'swimlaneCount': {{count($swimlanes)}}, 'cardCount': {{count($cards)}} };
</script>

@endsection
