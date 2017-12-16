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

    //console.log("Target category ID: " + targetCategoryId + " Target swimlane ID: " + targetSwimlaneId + " Card ID: " + cardId);

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
