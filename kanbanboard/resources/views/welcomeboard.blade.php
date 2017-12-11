@extends('layouts.app')

@section('head')

    <title>Board</title>

@endsection

@section('content')


<body class="signup">

  <table>
    @if(count($parentCategories) > 0)
      <tr>
        <th></th>
        <?php $emptyColumns = 0; ?>
        @foreach($categories as $category)
          @if(is_null($category['parentcategory']))
            <?php $emptyColumns++; ?>
          @endif
        @endforeach
        <th colspan="{{$emptyColumns++}}"></th>

        <?php $colSpanForParentCategory = 0; ?>
        @foreach($parentCategories as $parentCategory)
          @foreach($categories as $category)
            @if($category['parentcategory'] == $parentCategory['id'])
              <?php $colSpanForParentCategory++; ?>
            @endif
          @endforeach
          <th colspan="{{$colSpanForParentCategory}}">{{$parentCategory['name']}}</th>
          <?php $colSpanForParentCategory = 0 ?>
        @endforeach
      </tr>
    @endif
    <tr>
      <th></th>
      @foreach($categories as $category)
        <th>{{ $category["name"] }}</th>
      @endforeach
    </tr>

    @foreach($swimlanes as $swimlane)
    <tr>
      <td>{{ $swimlane["name"] }}</td>
      @foreach($categories as $category)
        <td id="c{{$category['id']}}s{{$swimlane['id']}}" category_id='{{$category["id"]}}' swimlane_id='{{$swimlane["id"]}}'>
          @foreach($cards as $card)
            @if($card["swimlane_id"] == $swimlane["id"] && $card["category_id"] == $category["id"])
              <div class='card' id="card{{$card['id']}}">Card {{ $card["id"] }}</div>
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
              <div class='card' id="card{{$card['id']}}">Card {{ $card["id"] }}</div>
            @endif
          @endforeach
        </td>
      @endforeach
    </tr>
  </table>

</body>

@endsection
