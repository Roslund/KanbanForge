console.log("Successfully loaded in boardFunctionality.js");
var cardsTimestamp;

// Check for if jQuery is defined.
var table = $('table');
if(table == undefined)
{
  console.log("jQuery isn't defined.");
}

// Drag and drop start
function allowDrop(ev)
{
  ev.preventDefault();
}

function drag(ev)
{
  //setUpdateTimerState(0);
  console.log("Drag start");

  var categoryId = ev.currentTarget.parentElement.id;

  console.log(ev.target.id + " is being dragged.");

  ev.dataTransfer.setData("cardId", ev.target.id);
}

function drop(ev)
{
  ev.preventDefault();

  var dragTarget = ev.dataTransfer.getData("cardId");
  var cardElement = document.getElementById(dragTarget);

  // This makes it so that the add/remove only happens if the
  // card was actually moved to another drop zone.
  if(cardElement.parentNode != ev.currentTarget)
  {
    var targetCategoryId = ev.currentTarget.getAttribute("category_id");
    var targetSwimlaneId = ev.currentTarget.getAttribute("swimlane_id");
    var cardId = cardElement.getAttribute("card_id");

    // We need to actually set it to null, otherwise we'd be sending
    // a string with the value of "null".
    if(targetSwimlaneId === "null") {
      targetSwimlaneId = null;
    }

    ajaxUpdateCard(cardId, targetCategoryId, targetSwimlaneId);

    ev.currentTarget.appendChild(cardElement);
  }

  console.log("Drag end");
}

// As there's a possibility that the user drops the card in a non-droppable
// area we have to account for this.
document.addEventListener('dragend', function(event) {
  // dropEffect is set to "move" if the card was moved and set to "none"
  // if it was dropped in a area other than a dropzone.
  if(event.dataTransfer.dropEffect == "none")
  {
    console.log("Drag cancelled");
  }
});
// Drag and drop end

// Ajax related functions start
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function ajaxUpdateCard(id, category_id, swimlane_id)
{
  console.log("id: " + id + "\n category_id: " + category_id + "\n swimlane_id: " + swimlane_id);
  $.ajax({
    url: "/api/cards/" + id,
    data: {
      category_id: category_id,
      swimlane_id: swimlane_id
    },
    method: "PUT",
    success: function( result ) {
      // As this is an async function we have to return the timestamp in a callback.
      //handleTimestampFromAjaxCardUpdate(result["timestamp"]);
    }, error: function (xhr, ajaxOptions, thrownError){
      $jsonXHR = JSON.stringify(xhr.responseText);
      console.log(JSON.parse($jsonXHR));
    }
  });
};
