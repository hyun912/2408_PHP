///////////////
// 요소 선택 //
//////////////
//

///////////////////////////////////
// document.getElementById("id") //
///////////////////////////////////
// id 로 선택
const TITLE = document.getElementById("title");

//
///////////////////////////////////////////////
// document.getElementsByTagName("tag name") //
///////////////////////////////////////////////
// 태그명으로 선택, 안씀
const H1 = document.getElementsByTagName("h1");
H1[1].style.color = "blue"; // 같은게 여러개일경우 배열식 번호 지정

//
///////////////////////////////////////////////////
// document.getElementsByClassName("class name") //
///////////////////////////////////////////////////
// 클래스명 선택, 안씀
const CALSS_NONE_LI = document.getElementsByClassName("none-li");

//
/////////////////////////////////////////////
// document.querySelector("#id or .class") //
/////////////////////////////////////////////
// CSS 선택자, **가장 많이씀
const SICK = document.querySelector("#sick");
const NONE_LI = document.querySelector(".none-li"); // 같은게 여러개면 첫번째것만 가져옴
const ALL_NONE_LI = document.querySelectorAll(".none-li"); // 여러개면 첫번째것만 가져와서 All 붙이면 다가져옴

// li 홀 빨강, 짝 파랑
const LI = document.querySelectorAll("li");
LI.forEach((val, key) => {
  if (key % 2 === 0) {
    val.style.color = "red";
  } else {
    val.style.color = "blue";
  }
});

//
///////////////
// 요소 조작 //
//////////////
//

//////////////////
// .textContent //
//////////////////
// 컨텐츠 획득 또는 변경, 순수 텍스트 데이터 전달
TITLE.textContent = "<a>링크</a>";

//
////////////////
// .innerHTML //
////////////////
// 컨텐츠 획득 또는 변경, 태그는 태그로 인식해 전달
TITLE.innerHTML = "<a>링크크</a>";

//
//////////////////////////////////
// .setAttribute("속성명", "값") //
//////////////////////////////////
// 해당 속성과 값을 추가
const A_LINK = document.querySelector("#title > a");
A_LINK.setAttribute("href", "#"); // a 태그에 href="#" 부여

//
////////////////////////////////
// .removeAttribute("속성명") //
///////////////////////////////
// 해당 속성을 제거
A_LINK.removeAttribute("href");

//
//////////////////
// 요소 스타일링 //
//////////////////
//

////////////
// .style //
////////////
// 인라인 CSS 추가
TITLE.style.color = "black";

//
////////////////
// .classList //
////////////////
// 클래스 CSS 추가 및 삭제
TITLE.classList.add("class-1", "class-2", "class-3"); // 추가
TITLE.classList.remove("class-1", "class-3"); // 삭제

//
/////////////////////////
// .toggle("클래스명") //
////////////////////////
// on/off 기능, 다시 입력하면 키거나 꺼짐
TITLE.classList.toggle("toggle");
TITLE.classList.toggle("toggle");

//
/////////////////
// 새 요소 생성 //
/////////////////
//

//////////////////////////////
// .createElement("태그명") //
/////////////////////////////
// 새 요소 만들기
const NEW_LI = document.createElement("li");
NEW_LI.textContent = "떡볶이";

//
////////////////////////
// .appendChild(노드) //
////////////////////////
// 해당 부모 노드의 마지막 자식 노드 추가
const FOODS = document.querySelector("#foods");
FOODS.appendChild(NEW_LI);

//
////////////////////////
// .removeChild(노드) //
////////////////////////
// 해당 부모 노드의 마지막 자식 노드 삭제
FOODS.removeChild(NEW_LI);

//
//////////////////////////////////////
// .insertBefore(넣을노드, 기준노드) //
/////////////////////////////////////
// 해당 부모 노드 자식인 기준노드 앞에 새 노드를 추가
FOODS.insertBefore(NEW_LI, SICK);
