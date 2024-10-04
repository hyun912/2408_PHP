const button = document.querySelector("button");
const heading = document.querySelector("h1");

const isDark =
  document.documentElement.dataset.theme === "dark" ||
  matchMedia("(prefers-color-scheme: dark)").matches;
// heading.innerText = `Now with ${isDark ? "Light" : "Dark"} Mode.`;
button.setAttribute("aria-pressed", isDark ? false : true);
document.documentElement.dataset.theme = isDark ? "dark" : "light";

const sync = () => {
  const darkNow = button.matches("[aria-pressed=false]");
  document.documentElement.dataset.theme = darkNow ? "light" : "dark";
  //   heading.innerText = `Now with ${darkNow ? "Dark" : "Light"} Mode.`;
  button.setAttribute("aria-pressed", darkNow ? true : false);

  // 딱보니 light: true, dark: false 임
  // 페이지 이동&새로고침시 초기화를 막기위해 저장
  localStorage.setItem("theme", darkNow ? "light" : "dark");
};

const handleSync = () => {
  if (!document.startViewTransition) return sync();
  document.startViewTransition(sync);
};

button.addEventListener("click", handleSync);

// 다크모드 상태에서 페이지 이동&새로고침시 저장된걸 불러옴
if (localStorage.getItem("theme") === "dark") {
  document.documentElement.dataset.theme = "dark";
  button.setAttribute("aria-pressed", false);
}
// else{} // light값은 처리안해도 되냐고? 차피 냅둬도 초기값으로 세팅되는데 굳이??
