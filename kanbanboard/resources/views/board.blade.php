@extends('layouts.kanbanboard')

@section('head')

<title>Board</title>

@endsection

@section('content')

<h1>Kanban Board</h1>
<hr>

<div class="tbl-board">
  @if(count($categories) > 0)
  <table cellpadding="0" cellspacing="0" border="0">
    <thead>
      @if(count($parentCategories) > 0)
          <?php
            $last = -1;
            $counter = -1;
            $parentCategoriesOrder = array();
          ?>
          @foreach($categories as $category)
            <?php
              if($last != $category['parentcategory'])
              {
                $counter++;
                $parentCategoriesOrder[$counter] = [ "value" => $category['parentcategory'], "count" => 1 ];
              }
              else {
                $parentCategoriesOrder[$counter]["count"]++;
              }
              $last = $category['parentcategory'];
            ?>
          @endforeach

          @if(count($parentCategoriesOrder) > 1 || (count($parentCategoriesOrder) == 1 && $parentCategoriesOrder[0]['value'] != null))
            <tr>
              <th class="empty-th"></th>
            @foreach($parentCategoriesOrder as $group)
              <th colspan="{{$group['count']}}">
                <?php
                  if(!is_null($group['value']))
      						{
      							echo $parentCategories[$group['value']]['name'];
      						}
      						else
      						{
      							echo " ";
      						}
                ?>
              </th>
            @endforeach
            </tr>
          @endif
      @endif

      <tr>
        <th class="empty-th"></th>
        @foreach($categories as $category)
          <th>{{ $category["name"] }}</th>
        @endforeach
      </tr>
    </thead>

    <tbody>
      @foreach($swimlanes as $swimlane)
        <tr>
        <th>{{ $swimlane["name"] }}</th>
        @foreach($categories as $category)
          <td id="c{{$category['id']}}s{{$swimlane['id']}}" category_id='{{$category["id"]}}' swimlane_id='{{$swimlane["id"]}}'>
            @foreach($cards as $card)
              @if($card["swimlane_id"] == $swimlane["id"] && $card["category_id"] == $category["id"])
              <div class='card' id="card{{$card['id']}}" card_id="{{$card['id']}}">
                Card {{ $card["id"] }}
                Assignee:
                Description:
              </div>
              @endif
            @endforeach
          </td>
        @endforeach
      </tr>
      @endforeach

      <tr>
        <td>&nbsp;</td>
        @foreach($categories as $category)
          <td id="c{{$category['id']}}snull" category_id='{{$category["id"]}}' swimlane_id='null'>
            @foreach($cards as $card)
              @if(is_null($card["swimlane_id"]) && $card["category_id"] == $category["id"])
              <div class='card' id="card{{$card['id']}}" card_id="{{$card['id']}}">
                Card {{ $card["id"] }}
                Assignee:
                Description:
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

<!-- This is to inject the current server timestamp into the cardsTimestamp variable -->
<!-- Can't inject it directly into the javascript as it doesn't get compiled with blade -->
<!-- This needs to be done after the javascript above has loaded in, which is why it's under it -->
<script type="text/javascript">cardsTimestamp = "{{date('Y-m-d H:i:s')}}";</script>

@endsection
