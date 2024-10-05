var dragSrcEl = null;

function handleDragStart(e) {
  // 대상(이) 요소가 소스 노드입니다.
  dragSrcEl = this;

  e.dataTransfer.effectAllowed = "move";
  e.dataTransfer.setData("text/html", this.outerHTML);

  this.classList.add("dragElem");
}
function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // 필요합니다. 드롭할 수 있습니다.
  }
  this.classList.add("over");

  e.dataTransfer.dropEffect = "move"; // DataTransfer 개체의 섹션을 참조하십시오.

  return false;
}

function handleDragEnter(e) {
  // this/e.target 이 현재 호버 타겟입니다.
}

function handleDragLeave(e) {
  this.classList.remove("over"); // this/e.target은 이전 대상 요소입니다.
}

function handleDrop(e) {
  // this/e.target은 현재 대상 요소입니다.

  if (e.stopPropagation) {
    e.stopPropagation(); // 일부 브라우저의 리디렉션을 중지합니다.
  }

  // 드래그하는 것과 동일한 열을 떨어뜨려도 아무것도 하지 마세요.
  if (dragSrcEl != this) {
    // 소스 열의 HTML을 삭제한 열의 HTML로 설정합니다.

    //alert(this.outerHTML);
    //dragSrcEl.innerHTML = this.innerHTML;
    //this.innerHTML = e.dataTransfer.getData('text/html');
    this.parentNode.removeChild(dragSrcEl);
    var dropHTML = e.dataTransfer.getData("text/html");
    this.insertAdjacentHTML("beforebegin", dropHTML);
    var dropElem = this.previousSibling;
    addDnDHandlers(dropElem);
  }
  this.classList.remove("over");
  return false;
}

function handleDragEnd(e) {
  // this/e.target이 소스 노드입니다.
  this.classList.remove("over");

  /*[].forEach.call(cols, function (col) {
    col.classList.remove('over');
  });*/
}

function addDnDHandlers(elem) {
  elem.addEventListener("dragstart", handleDragStart, false);
  elem.addEventListener("dragenter", handleDragEnter, false);
  elem.addEventListener("dragover", handleDragOver, false);
  elem.addEventListener("dragleave", handleDragLeave, false);
  elem.addEventListener("drop", handleDrop, false);
  elem.addEventListener("dragend", handleDragEnd, false);
}

var cols = document.querySelectorAll("#columns .column");
[].forEach.call(cols, addDnDHandlers);
