const step = 120;

const items = document.querySelectorAll(".element");
var saveTab = document.querySelector("#save_tab");

var itemsArray = []; //0 - obj; 1 - top
var selectedItem = null;
var initY = null;
var selectedInitialTop = null;

function chkFormSubmit(event) {
  event.preventDefault(); // 일단 폼전송 멈춤

  // 필요한값 id, number, name
  // id : itemId
  // number : index + 1
  // name : itemInput.value

  const arrTabs = []; // 빈 배열 선언 및 초기화

  items.forEach(function (item, index) {
    var itemId = item.querySelector("#id"); // ID
    var itemNum = item.id; // 로직이 여기 id를 순번으로 놓음
    var itemName = item.querySelector("#name"); // NAME

    var itemArr = {
      id: itemId.value,
      number: parseInt(itemNum) + 1, // + 1을 넣는 이유는 시작이 0이라서 1부터 시작하도록 설정함
      name: itemName.value,
    }; // 넣을 배열변수 만들고

    arrTabs.push(itemArr); // 전송할 배열에 집어넣음
  });

  saveTab.value = JSON.stringify(arrTabs); // 다된걸 인코딩헤서 집어넣고

  // console.log(saveTab.value);

  event.target.submit(); // 그대로 전송
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
