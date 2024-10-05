const step = 120;

var items = document.querySelectorAll(".element");
var itemsArray = []; //0 - obj; 1 - top
var selectedItem = null;
var initY = null;
var selectedInitialTop = null;

function chkValue() {
  items.forEach(function (item, index) {
    // console.log(index + 1); // key, 순번저장
    // const itemChild = item.querySelector("#name"); // input
    // console.log(itemChild.value);

    console.log(item);
  });
}

function swapItems(index, currY) {
  var pre = index - 1;
  var nxt = index + 1;
  var currMiddle =
    selectedItem.getBoundingClientRect().top +
    (selectedItem.getBoundingClientRect().bottom -
      selectedItem.getBoundingClientRect().top) /
      2;

  if (currY - initY < 0) {
    //moving up: step++; pre
    if (
      pre > -1 &&
      itemsArray[pre][0].getBoundingClientRect().top +
        (itemsArray[pre][0].getBoundingClientRect().bottom -
          itemsArray[pre][0].getBoundingClientRect().top) /
          2 -
        currMiddle >
        0
    ) {
      itemsArray[pre][0].style.top = itemsArray[pre][1] + step + "px"; //move down by step
      //update in array
      itemsArray[pre][1] += step; //update top
      itemsArray[index][1] -= step; //update top in current
      //swap
      var tmp = itemsArray[index]; //save curr
      var tmpID = itemsArray[index][0].id;
      //swap ids
      itemsArray[index][0].id = itemsArray[pre][0].id;
      itemsArray[pre][0].id = tmpID;
      //swap arr items
      itemsArray[index] = itemsArray[pre];
      itemsArray[pre] = tmp;
      //reset offset
      selectedInitialTop += currY - initY;
      initY = currY;
    }
  } else {
    //moving down: step--; nxt
    if (
      nxt < itemsArray.length &&
      itemsArray[nxt][0].getBoundingClientRect().top +
        (itemsArray[nxt][0].getBoundingClientRect().bottom -
          itemsArray[nxt][0].getBoundingClientRect().top) /
          2 -
        currMiddle <
        0
    ) {
      itemsArray[nxt][0].style.top = itemsArray[nxt][1] - step + "px"; //move up by step
      //update in array
      itemsArray[nxt][1] -= step; //update top
      itemsArray[index][1] += step; //update top in current
      //swap
      var tmp = itemsArray[index]; //save curr
      var tmpID = itemsArray[index][0].id;
      //swap ids
      itemsArray[index][0].id = itemsArray[nxt][0].id;
      itemsArray[nxt][0].id = tmpID;
      //swap arr items
      itemsArray[index] = itemsArray[nxt];
      itemsArray[nxt] = tmp;
      //reset offset
      selectedInitialTop += currY - initY;
      initY = currY;
    }
  }
}

//init
items.forEach(function (item, index) {
  item.style.top = "0px";
  item.id = index; //id asc order
  itemsArray.push([
    item,
    parseInt(item.style.top.substring(0, item.style.top.length - 2), 10),
  ]); //save obj and top css property
  //add event
  item.addEventListener("mousedown", function (e) {
    selectedItem = e.target;
    initY = e.clientY;
    selectedInitialTop = parseInt(
      e.target.style.top.substring(0, e.target.style.top.length - 2),
      10
    ); //value of top css property
    //console.log(e);
    e.target.style.zIndex = 10;
    e.target.classList.add("moving");
  });
});

window.addEventListener("mouseup", function (e) {
  if (selectedItem != null) {
    selectedItem.classList.remove("moving");
    selectedItem.style.zIndex = 0;
    selectedItem.style.top = itemsArray[selectedItem.id][1] + "px";
    selectedItem = null;
    initY = null;
    selectedInitialTop = null;
  }
});

window.addEventListener("mousemove", function (e) {
  if (selectedItem != null) {
    var pos = e.clientY - initY + selectedInitialTop; //calc new offset
    selectedItem.style.top = pos + "px"; //rewrite top
    swapItems(parseInt(e.target.id, 10), e.clientY, null); //check swapping
  }
});
